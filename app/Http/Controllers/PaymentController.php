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

            $existingTransaction = Transaksi::where('user_id', auth()->id())
                ->where('tiket_id', $validated['tiket_id'])
                ->where('status', 'pending')
                ->first();

            if ($existingTransaction) {
                $existingTransaction->delete(); 
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
            ]);

            $transaction = [
                'transaction_details' => [
                    'order_id' => $transaksi->id . '-' . time(), // Order ID unik
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

            $url = Snap::createTransaction($transaction)->redirect_url;

            DB::commit();

            return redirect($url);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Gagal membuat transaksi: ' . $e->getMessage()]);
        }
    }

    public function midtransCallback(Request $request)
{
    $payload = $request->all();

    if (!isset($payload['transaction_status']) || !isset($payload['order_id'])) {
        return response()->json(['status' => 'error', 'message' => 'Invalid payload.'], 400);
    }

    $transaction_status = $payload['transaction_status'];
    $order_id = explode('-', $payload['order_id'])[0]; 

    $transaksi = Transaksi::find($order_id);
    if (!$transaksi) {
        return response()->json(['status' => 'error', 'message' => 'Transaction not found.'], 404);
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
}


}