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

    // public function KirimTiket()
    // {
    //     return view('emails.kirimTiket');
    // }

    public function postKirimTiket(Request $request, $id)
{
    $request->validate([
        'id_transaksi' => 'required|exists:transaksis,id',
    ]);

    $transaksi = Transaksi::find($id);

    if ($transaksi) {
        try {
            Mail::to($transaksi->email_pembeli)
                ->send(new kirimTiket($transaksi));

                return redirect()->back()->with('status', 'Transaksi berhasil! Email telah dikirim.');

        } catch (\Exception $e) {
            // Error log untuk informasi lebih lanjut
            Log::error("Email Gagal: ".$e->getMessage());

            return response()->json([
                'message' => 'Transaksi berhasil, tetapi email gagal dikirim.',
                'status' => 'warning',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    return response()->json([
        'message' => 'Transaksi tidak ditemukan',
        'status' => 'error'
    ], 404);

}

            

}
