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
use Midtrans\Notification;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
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

        // Validasi no_ktp untuk event yang sama
        $eventId = $tiket->event_id;
        $existingTransaction = Transaksi::where('no_ktp', $validated['no_ktp'])
            ->where('event_id', $eventId)
            ->where('status', '!=', 'failed') // Hanya transaksi berhasil atau pending yang dicek
            ->exists();

        if ($existingTransaction) {
            return back()->withErrors(['error' => 'Nomor KTP ini sudah digunakan untuk event ini.']);
        }

        $order_id = Auth::id() . '-' . time();

        $transaksi = Transaksi::create([
            'tiket_id' => $validated['tiket_id'],
            'tiket_dibeli' => $validated['tiket_dibeli'],
            'tanggal_transaksi' => now(),
            'total_transaksi' => $validated['tiket_dibeli'] * $tiket->harga_tiket,
            'nama_lengkap' => $validated['nama_lengkap'],
            'no_ktp' => $validated['no_ktp'],
            'no_telepon' => $validated['no_telepon'],
            'email' => $validated['email'],
            'event_id' => $eventId,
            'status' => 'pending',
            'user_id' => auth()->id(),
            'order_id' => $order_id,
            'exp' => now()->addHours(1),
        ]);

        $transaction = [
            'transaction_details' => [
                'order_id' => $order_id,
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
                'finish' => route('midtrans-callback'),
                'unfinish' => route('history'),
                'error' => route('transaksi.create'),
            ],
        ];

        $snapToken = Snap::createTransaction($transaction)->token;
        $transaksi->snap_token = $snapToken;
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
          $payload = $request->all();


    if (!isset($payload['transaction_status']) || !isset($payload['order_id'])) {
        return redirect()->route('transaksi.create')->withErrors(['error' => 'Invalid payload structure.']);
    }

    $transaction_status = $payload['transaction_status'];
    $order_id = $payload['order_id'];

    $transaksi = Transaksi::where('order_id', $order_id)->first();
    if (!$transaksi) {
        return redirect()->route('transaksi.create')->withErrors(['error' => 'Transaction not found.']);
    }

    if ($transaksi->status === 'paid') {
        return redirect()->route('history')->with('success', 'Transaction already processed.');
    }

        try {
            if (in_array($transaction_status, ['settlement', 'capture'])) {
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
                Mail::to($transaksi->email)->send(new kirimTiket($transaksi));
            } elseif ($transaction_status === 'pending') {
                $transaksi->status = 'pending';
            } elseif (in_array($transaction_status, ['deny', 'cancel', 'expire'])) {
                $transaksi->status = 'failed';
            }

            $transaksi->save();

            return redirect()->route('history')->with('success', 'Transaction updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Failed to update transaction.'], 500);
        }
    }

    public function handleNotification(Request $request)
    {
        $payload = $request->all();

        Log::info('Payload received from Midtrans', ['payload' => $payload]);

        if(!$payload) {
            return response()->json(['status' => 'error', 'message' => 'Payload is empty.'], 400);
        }

        $transaction_status = $payload['transaction_status'];
        $order_id = $payload['order_id'];

        $transaksi = Transaksi::where('order_id', $order_id)->first();
        if (!$transaksi) {
            return response()->json(['status' => 'error', 'message' => 'Transaction not found.'.$order_id], 404);
        }

        if ($transaction_status === 'settlement') {
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
            $transaksi->save();
            Mail::to($transaksi->email)->send(new kirimTiket($transaksi));
        } elseif ($transaction_status === 'pending') {
            $transaksi->status = 'pending';
        } elseif (in_array($transaction_status, ['deny', 'cancel', 'expire'])) {
            $transaksi->status = 'failed';
        } elseif ($transaction_status == 'pending') {
            $transaksi->status = 'pending';
        }

        return response()->json(['status' => 'success', 'message' => 'Notification handled.']);
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

        return redirect()->route('history')->with('success', 'Transaction deleted successfully.');
    }public function lanjutkanPembayaran($id)
{
    // Ambil transaksi berdasarkan ID
    $transaksi = Transaksi::findOrFail($id);

    if ($transaksi->status === 'paid') {
        return redirect()->route('history')->with('success', 'Transaksi sudah dibayar.');
    }

    // Buat Snap Token baru jika belum ada atau sudah kadaluarsa
    if (!$transaksi->snap_token || Carbon::now()->greaterThan($transaksi->exp)) {
        $payload = [
            'transaction_details' => [
                'order_id' => $transaksi->order_id,
                'gross_amount' => $transaksi->total_transaksi,
            ],
            'customer_details' => [
                'first_name' => $transaksi->nama_lengkap,
                'email' => $transaksi->email,
                'phone' => $transaksi->no_telepon,
            ]
        ];

        try {
            $snapToken = Snap::getSnapToken($payload);
            $transaksi->snap_token = $snapToken;
            $transaksi->exp = now()->addHours(24); // Set expiry 24 jam
            $transaksi->save();
        } catch (\Exception $e) {
            return redirect()->route('history')->with('error', 'Gagal membuat Snap Token: ' . $e->getMessage());
        }
    }

    // Redirect ke URL Midtrans dengan Snap Token
    return redirect('https://app.sandbox.midtrans.com/snap/v4/redirection/' . $transaksi->snap_token);
}
}
