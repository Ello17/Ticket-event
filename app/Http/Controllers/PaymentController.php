<?php

namespace App\Http\Controllers;

use App\Mail\kirimTiket;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Tiket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Snap;
use Midtrans\Config;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
use Milon\Barcode\Facades\DNS2DFacade as DNS2D;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function createTransaction(Request $request)
    {
        $validated = $request->validate([
            'tiket_id' => 'required|exists:tikets,id',
            'tiket_dibeli' => 'required|integer|min:1',
            'nama_lengkap' => 'required|string|max:255',
            'no_ktp' => 'required|digits:16',
            'no_telepon' => 'required|regex:/^\d{10,15}$/',
            'email' => 'required|email|max:255',
        ]);

        try {
            DB::beginTransaction();

            $tiket = Tiket::findOrFail($validated['tiket_id']);

            if ($tiket->jumlah_tiket < $validated['tiket_dibeli']) {
                return back()->withErrors(['error' => 'Stok tiket tidak mencukupi.']);
            }

            $transaksi = Transaksi::create([
                'tiket_id' => $validated['tiket_id'],
                'tiket_dibeli' => $validated['tiket_dibeli'],
                'tanggal_transaksi' => now(),
                'total_transaksi' => $validated['tiket_dibeli'] * $tiket->harga_tiket,
                'nama_lengkap' => $validated['nama_lengkap'],
                'no_ktp' => $validated['no_ktp'],
                'no_telepon' => $validated['no_telepon'],
                'email' => $validated['email'],
                'event_id' => $tiket->event_id,
                'status' => 'pending',
                'user_id' => auth()->id(),
                'exp' => null,
            ]);

            $transaction = [
                'transaction_details' => [
                    'order_id' => $transaksi->id . '-' . time(),
                    'gross_amount' => $transaksi->total_transaksi,
                ],
                'item_details' => [
                    [
                        'id' => $tiket->id,
                        'price' => $tiket->harga_tiket,
                        'quantity' => $validated['tiket_dibeli'],
                        'name' => $tiket->kategori_tiket,
                    ],
                ],
                'customer_details' => [
                    'first_name' => $validated['nama_lengkap'],
                    'email' => $validated['email'],
                    'phone' => $validated['no_telepon'],
                ],
                'callbacks' => [
                    'finish' => route('midtransCallback'),
                    'unfinish' => route('history'),
                    'error' => route('transaksi.create'),
                ],
            ];

            $snapToken = Snap::createTransaction($transaction)->token;
            $transaksi->snap_token = $snapToken;
            $transaksi->save();

            if ($transaksi->status == 'pending') {
                $transaksi->exp = now()->addHour(1);
            }
            $transaksi->save();

            DB::commit();

            return redirect(Snap::createTransaction($transaction)->redirect_url);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Transaksi gagal', ['error' => $e->getMessage()]);
            return back()->withErrors(['error' => 'Gagal membuat transaksi: ' . $e->getMessage()]);
        }
    }

    public function midtransCallback(Request $request)
    {
        $json = $request->getContent();
        $data = json_decode($json);
    
        $orderId = explode('-', $data->order_id)[0]; 
        $transaksi = Transaksi::find($orderId);
    
        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }
    
        if ($data->transaction_status == 'settlement' || $data->transaction_status == 'capture') {
            $transaksi->status = 'paid';
    
            foreach (range(1, $transaksi->tiket_dibeli) as $i) {
                Participant::create([
                    'transaksi_id' => $transaksi->id,
                    'kode_tiket' => $transaksi->id . '-' . Str::random(8),
                    'user_id' => $transaksi->user_id,
                    'event_id' => $transaksi->event_id,
                    'tiket_id' => $transaksi->tiket_id,
                    'scan_time' => null,
                    'is_present' => false,
                ]);
            }
        } elseif (in_array($data->transaction_status, ['cancel', 'expire', 'deny'])) {
            $transaksi->status = 'failed';
        }
    
        $transaksi->save();
        return response()->json(['message' => 'Callback processed successfully']);
    }
     
    public function payTransaction($id)
{
    try {
        $transaksi = Transaksi::findOrFail($id);

        if ($transaksi->status !== 'pending') {
            return back()->withErrors(['error' => 'Transaksi tidak dapat diproses ulang karena statusnya bukan pending.']);
        }

        // Cek apakah snapToken sudah ada
        if (!$transaksi->snap_token) {
            // Jika belum ada, buat transaksi baru
            $transaction = [
                'transaction_details' => [
                    'order_id' => $transaksi->id . '-' . time(),
                    'gross_amount' => $transaksi->total_transaksi,
                ],
                'item_details' => [
                    [
                        'id' => $transaksi->tiket_id,
                        'price' => $transaksi->tiket->harga_tiket,
                        'quantity' => $transaksi->tiket_dibeli,
                        'name' => $transaksi->tiket->kategori_tiket,
                    ],
                ],
                'customer_details' => [
                    'first_name' => $transaksi->nama_lengkap,
                    'email' => $transaksi->email,
                    'phone' => $transaksi->no_telepon,
                ],
                'finish_redirect_url' => route('midtransCallback'),
            ];

            // Buat transaksi baru dengan Snap API
            $snapTransaction = Snap::createTransaction($transaction);
            $transaksi->snap_token = $snapTransaction->token;
            $transaksi->save();
        }

        // Redirect ke halaman pembayaran menggunakan snapToken yang ada
        return redirect(Snap::createTransaction($transaksi->snap_token));
    } catch (\Exception $e) {
        Log::error('Gagal memproses ulang transaksi', ['error' => $e->getMessage()]);
        return back()->withErrors(['error' => 'Gagal memproses ulang transaksi: ' . $e->getMessage()]);
    }
}

    
    public function notificationHandler(Request $request)
    {
        $payload = $request->all();
        $order_id = explode('-', $payload['order_id'])[0];
        $transaction_status = $payload['transaction_status'];

        $transaksi = Transaksi::find($order_id);
        if (!$transaksi) {
            return response()->json(['status' => 'error', 'message' => 'Transaction not found.'], 404);
        }

        if ($transaction_status == 'settlement') {
            $transaksi->status = 'paid';
            $tiket = Tiket::findOrFail($transaksi->tiket_id);
            $tiket->decrement('jumlah_tiket', $transaksi->tiket_dibeli);

            foreach (range(1, $transaksi->tiket_dibeli) as $i) {
                Participant::create([
                    'transaksi_id' => $transaksi->id,
                    'kode_tiket' => $transaksi->id . '-' . Str::random(8),
                    'user_id' => $transaksi->user_id,
                    'event_id' => $transaksi->event_id,
                    'tiket_id' => $transaksi->tiket_id,
                    'scan_time' => null,
                    'is_present' => false,
                ]);
            }
        } elseif (in_array($transaction_status, ['deny', 'cancel', 'expire'])) {
            $transaksi->status = 'failed';
        } elseif ($transaction_status == 'pending') {
            $transaksi->status = 'pending';
        }

        $transaksi->save();

        return response()->json(['status' => 'success', 'message' => 'Notification processed successfully.']);
    }

    public function show($kode_tiket)
    {
        $participant = Participant::where('kode_tiket', $kode_tiket)->first();

        if ($participant && $participant->transaksi) {
            $transaksi = $participant->transaksi;
            return view('customer.history', compact('transaksi'));
        } else {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }
    }

    public function downloadTiket($id)
    {
        $transaksi = Transaksi::with('participants')->findOrFail($id);
        if ($transaksi->user_id !== auth()->id()) {
            abort(403, 'Anda tidak diizinkan untuk mengakses tiket ini.');
        }

        $qrcodes = [];
        foreach ($transaksi->participants as $participant) {
            $qrcode = DNS2D::getBarcodeHTML($participant->kode_tiket, 'QRCODE');
            $qrcodes[] = [
                'kode_tiket' => $participant->kode_tiket,
                'qrcode' => $qrcode,
            ];
        }

        $pdf = Pdf::loadView('customer.downloadTiket', compact('transaksi', 'qrcodes'))
                  ->setPaper('a4');

        return $pdf->download('tiket-transaksi-' . $transaksi->id . '.pdf');
    }

    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('history')->with('success', 'Transaksi berhasil dihapus.');
    }
}
