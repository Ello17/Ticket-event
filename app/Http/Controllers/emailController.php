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
    public function callbackMidtrans(Request $request)
    {
        $serverKey = 'SB-Mid-server-CnJxn_ehQltuNunsQNfJRl3m';
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed !== $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $transaksi = Transaksi::where('order_id', $request->order_id)->first();

        if (!$transaksi) {
            return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
        }

        if ($request->transaction_status == 'settlement') {
            $transaksi->status = 'paid';
            $transaksi->save();

            try {
                Mail::to($transaksi->email)->send(new kirimTiket($transaksi));
                session()->flash('success', 'Pesan telah dikirim ke email Anda');

                return response()->json(['message' => 'Email tiket berhasil dikirim'], 200);
            } catch (Exception $e) {
                Log::error('Gagal mengirim email: ' . $e->getMessage());
                return response()->json([
                    'message' => 'Gagal mengirim email tiket',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }

        return response()->json(['message' => 'Status tidak memenuhi syarat'], 200);
    }

    public function showConfirmation(Request $request)
    {
        // Ambil transaksi yang berdasarkan order_id yang mungkin dikirimkan sebagai parameter
        $transaksi = Transaksi::with('event')->where('order_id', $request->query('order_id'))->first();

        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        // Kirim email konfirmasi
        Mail::to($transaksi->email)->send(new \App\Mail\kirimTiket($transaksi));

        return view('emails.konfirmasi', compact('transaksi'));
    }
}

