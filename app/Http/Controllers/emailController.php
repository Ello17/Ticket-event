<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Mail\kirimTiket;
use Illuminate\Support\Facades\Mail;
use Exception;
use Illuminate\Support\Facades\Log;

class emailController extends Controller
{

    public function konfirmasi()
    {
        return view('emails.konfirmasi');
    }
    // public function callbackMidtrans(Request $request)
    // {
    //     $serverKey = 'SB-Mid-server-CnJxn_ehQltuNunsQNfJRl3m';
    //     $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

    //     if ($hashed !== $request->signature_key) {
    //         return response()->json(['message' => 'Invalid signature'], 403);
    //     }

    //     $transaksi = Transaksi::where('order_id', $request->order_id)->first();

    //     if (!$transaksi) {
    //         return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
    //     }

    //     if ($request->transaction_status == 'settlement') {
    //         $transaksi->status = 'paid';
    //         $transaksi->save();


    //     }

    //     return response()->json(['message' => 'Status tidak memenuhi syarat'], 200);
    // }

    // public function showConfirmation(Request $request)
    // {
    //     
    //     $transaksi = Transaksi::with('event')->where('order_id', $request->query('order_id'))->first();

    //     if (!$transaksi) {
    //         return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
    //     }

    //     return view('emails.konfirmasi', compact('transaksi'));
    // }
}

