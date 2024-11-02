<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Tiket;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Midtrans\Snap;
use Midtrans\Config;
use Barryvdh\DomPDF\Facade\Pdf;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
use Milon\Barcode\Facades\DNS2DFacade as DNS2D;

class PaymentController extends Controller
{
    public function __construct()
    {
        // MIDTRANS
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }



    public function createTransaction(Request $request)
    {

        \Midtrans\Config::$serverKey = 'SB-Mid-server-CnJxn_ehQltuNunsQNfJRl3m';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        
        $data = $request->validate([
            'tiket_id' => 'required|exists:tikets,id',
            'nama_lengkap' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'no_ktp' => 'required|string|digits:16',
            'email' => 'required|string|email|max:255',
            'tiket_dibeli' => 'required|integer|min:1',
        ]);

        $tiket = Tiket::find($data['tiket_id']);
        $tiketTersedia = $tiket->jumlah_tiket; 
        $tiketTersedia = $tiket->jumlah_tiket;

        if ($data['tiket_dibeli'] > $tiketTersedia) {
            return redirect()->back()->withErrors(['message' => 'Tiket tidak tersedia atau melebihi kuota.']);
        }

        $order_id = $tiket->id . '-' . time();
        $transaksi = Transaksi::create([
            'tiket_id' => $tiket->id,
            'tiket_dibeli' => $data['tiket_dibeli'],
            'tanggal_transaksi' => now()->toDateString(),
            'no_rekening' => '1234567890',
            'total_transaksi' => $tiket->harga_tiket * $data['tiket_dibeli'],
            'nama_lengkap' => $data['nama_lengkap'],
            'no_ktp' => $data['no_ktp'],
            'no_telepon' => $data['no_telepon'],
            'email' => $data['email'],
            'event_id' => $tiket->event_id,
            'status' => 'pending',
           'user_id' => auth()->id(),
        ]);

        
        $tiket->decrement('jumlah_tiket', $data['tiket_dibeli']);

        $transaction = [
            'transaction_details' => [
                'order_id' => $order_id,
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
                'finish' => route('history'),
                'unfinish' => route('homeCustomer'),
                'error' => route('homeCustomer'),
            ]
        ];

        $url = Snap::createTransaction($transaction)->redirect_url;
        return redirect($url);
    }



 // Notifikasi pembayaran dari Midtrans
 public function notificationHandler(Request $request)
 {
     $payload = $request->getContent();
     $notification = json_decode($payload);

     $transactionStatus = $notification->transaction_status;
     $orderID = $notification->order_id;

     $transaksi = Transaksi::find($orderID);

     if ($transaksi) {
         if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
             $transaksi->status = 'paid';
             $tiket = Tiket::find($transaksi->tiket_id);
             $tiket->reduceQuantity($transaksi->tiket_dibeli);
             $tiket->save();
         } elseif ($transactionStatus == 'pending') {
             $transaksi->status = 'pending';
         } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
             $transaksi->status = 'failed';
         }

         $transaksi->save();
     } else {
         return response()->json(['pesan-gagal' => 'Transaction not found'], 404);
     }

     return response()->json(['pesan-berhasil' => 'success']);
 }

 public function midtransCallback(Request $request)
{
    $payload = $request->all();
    $transaction_status = $payload['transaction_status'];
    $order_id = $payload['order_id'];
    $transaksi = Transaksi::where('order_id', $order_id)->first();

    if ($transaksi) {
        $transaksi->status = $transaction_status;
        $transaksi->save();
        if ($transaction_status == 'success') {
            return redirect()->route('history')->with('pesan-berhasil', 'Pembayaran berhasil. Terima kasih!');
        }
    }
    return redirect()->route('history')->with('pesan-gagal', 'Pembayaran tidak berhasil.');
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

        // Buat QR Code menggunakan Milon
        $qrcode = DNS2D::getBarcodeHTML($transaksi->kode_tiket, 'QRCODE');

        // Buat Barcode menggunakan Milon
        $barcode = DNS1D::getBarcodeHTML($transaksi->kode_tiket, 'C39');

        // Generate PDF dengan view
        $pdf = Pdf::loadView('customer.downloadTiket', compact('transaksi', 'qrcode', 'barcode'));
        return $pdf->download('tiket-' . $transaksi->kode_tiket . '.pdf');
    }

}
