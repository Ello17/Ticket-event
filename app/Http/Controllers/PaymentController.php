<?php

namespace App\Http\Controllers;

use App\Mail\kirimTiket;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Tiket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Snap;
use Midtrans\Config;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
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
        $data = $request->validate([
            'tiket_id' => 'required|exists:tikets,id',
            'nama_lengkap' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'no_ktp' => 'required|string|digits:16',
            'email' => 'required|string|email|max:255',
            'tiket_dibeli' => 'required|integer|min:1',
        ]);

        $tiket = Tiket::find($data['tiket_id']);

        if ($data['tiket_dibeli'] > $tiket->jumlah_tiket) {
            return redirect()->back()->withErrors(['message' => 'Tiket tidak tersedia atau melebihi kuota.']);
        }

        $kode_tiket = $tiket->id . '-' . time();
        $transaksi = Transaksi::create([
            'tiket_id' => $tiket->id,
            'tiket_dibeli' => $data['tiket_dibeli'],
            'tanggal_transaksi' => now()->toDateString(),
            'total_transaksi' => $tiket->harga_tiket * $data['tiket_dibeli'],
            'nama_lengkap' => $data['nama_lengkap'],
            'no_ktp' => $data['no_ktp'],
            'no_telepon' => $data['no_telepon'],
            'email' => $data['email'],
            'event_id' => $tiket->event_id,
            'status' => 'pending',
            'user_id' => auth()->id(),
            'kode_tiket' => $kode_tiket,
        ]);

        $tiket->decrement('jumlah_tiket', $data['tiket_dibeli']);

        $transaction = [
            'transaction_details' => [
                'order_id' => $kode_tiket,
                'gross_amount' => $transaksi->total_transaksi,
            ],
            'item_details' => [
                [
                    'id' => $tiket->id,
                    'price' => $tiket->harga_tiket,
                    'quantity' => $data['tiket_dibeli'],
                    'name' => $tiket->kategori_tiket,
                ],
            ],
            'customer_details' => [
                'first_name' => $transaksi->nama_lengkap,
                'email' => $transaksi->email,
                'phone' => $transaksi->no_telepon,
            ],
            'callbacks' => [
                'finish' => route('midtransCallback'),
                'unfinish' => route('history'),
                'error' => route('transaksi.create'),
            ]
        ];

        try {
            Mail::to($transaksi->email)->send(new kirimTiket($transaksi));
        } catch (Exception $ex) {
            Log::error("Error sending email: " . $ex->getMessage());
        }

        $url = Snap::createTransaction($transaction)->redirect_url;
        return redirect($url);
    }

    public function midtransCallback(Request $request)
    {
        $payload = $request->all();
        Log::info('Midtrans Callback received:', $payload);

        $transaction_status = $payload['transaction_status'] ?? null;
        $kode_tiket = $payload['order_id'] ?? null;

        if (!$kode_tiket || !$transaction_status) {
            Log::error('Invalid callback payload', $payload);
            return response()->json(['status' => 'error', 'message' => 'Invalid callback payload.'], 400);
        }

        $transaksi = Transaksi::where('kode_tiket', $kode_tiket)->first();

        if ($transaksi) {
            Log::info('Transaction found:', ['kode_tiket' => $kode_tiket, 'status' => $transaction_status]);

            if (in_array($transaction_status, ['settlement', 'capture'])) {
                $transaksi->status = 'paid';
            } elseif ($transaction_status === 'pending') {
                $transaksi->status = 'pending';
            } elseif (in_array($transaction_status, ['deny', 'cancel', 'expire'])) {
                $transaksi->status = 'failed';
            } else {
                Log::warning('Unexpected transaction status:', ['status' => $transaction_status]);
            }

            $transaksi->save();

            Log::info('Transaction status updated:', [
                'kode_tiket' => $kode_tiket,
                'new_status' => $transaksi->status,
            ]);

            Mail::to($transaksi->email)->send(new kirimTiket($transaksi));


            return redirect()->route('history')->with(
                $transaction_status === 'settlement' || $transaction_status === 'capture'
                ? 'pesan-berhasil'
                : 'pesan-gagal',
                $transaction_status === 'settlement' || $transaction_status === 'capture'
                ? 'Pembayaran berhasil. Terima kasih!'
                : 'Pembayaran tidak berhasil.',
            );
        } else {
            Log::error('Transaction not found for kode_tiket:', ['kode_tiket' => $kode_tiket]);
            return response()->json(['status' => 'error', 'message' => 'Transaction not found.'], 404);
        }
    }
    public function show($kode_tiket)
    {
        $transaksi = Transaksi::where('kode_tiket', $kode_tiket)->first();

        if ($transaksi) {
            return view('transaksi.detail', compact('transaksi'));
        } else {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }
    }
    public function downloadTiket($id)
{
    $transaksi = Transaksi::findOrFail($id);
    $qrcodes = [];
    $barcodes = [];

    for ($i = 0; $i < $transaksi->tiket_dibeli; $i++) {
        // Buat QR Code dan Barcode
        $qrcode = DNS2D::getBarcodeHTML($transaksi->kode_tiket . '-' . ($i + 1), 'QRCODE');
        $barcode = DNS1D::getBarcodeHTML($transaksi->kode_tiket . '-' . ($i + 1), 'C39');

        $qrcodes[] = $qrcode;
        $barcodes[] = $barcode;
    }

    // Generate PDF
    $pdf = Pdf::loadView('customer.downloadTiket', compact('transaksi', 'qrcodes', 'barcodes'))
               ->setPaper('a4');

    return $pdf->download('tiket-' . $transaksi->kode_tiket . '.pdf');
}
}
