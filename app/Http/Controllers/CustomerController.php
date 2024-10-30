<?php

namespace App\Http\Controllers;

use App\Mail\kirimTiket;
use App\Models\Event;
use App\Models\Tiket;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class CustomerController extends Controller
{
    //

    function homeCustomer(){
        $data= Event::all();
        return view('customer.homeCustomer', compact('data'));

    }

    public function history()
{
    $transaksiList = Transaksi::with('tiket')
                    ->where('user_id', auth()->id())
                    ->get();

    return view('customer.history', compact('transaksiList'));
}

    public function detailEvent($id)
    {
        $event = Event::find($id);
        $tiket = Tiket::where('event_id', $id)->get();
        return view('customer.detailEvent', compact('event', 'tiket'));
    }

    public function listEvents()
{

    $events = Event::all();
    return view('customer.listEvent', compact('events'));
}

public function profil()
{
    $user = Auth::user();
    if ($user->role !== 'customer') {
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }

    return view('customer.profil', compact('user'));
}

public function editProfileCust($id)
{
    $user = Auth::user();
    if ($user->role !== 'customer' || $user->id != $id) {
        return redirect('/')->with('error', 'Anda tidak diizinkan mengakses halaman ini.');
    }

    return view('customer.editProfileCust', compact('user'));
}

public function postEditProfileCust(Request $request)
{
    $request->validate([
        'username' => 'required',
        'email' => 'required',
        'profil' => 'nullable|image',
    ]);

    $user = User::where('id', Auth::id())->first();
    if ($user->role !== 'customer') {
        return redirect('/')->with('error', 'Anda tidak diizinkan mengakses halaman ini.');
    }

    $user->username = $request->username;
    $user->email = $request->email;

    if ($request->hasFile('profil')) {
        $file = $request->file('profil');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = 'img/' . $fileName;

        Log::info('File upload: ' . $fileName);
        Log::info('File path: ' . $filePath);

        if ($user->profil && File::exists(public_path($user->profil))) {
            Log::info('Deleting old file: ' . public_path($user->profil));
            File::delete(public_path($user->profil));
        }

        $file->move(public_path('img'), $fileName);
        $user->profil = $filePath;
    }

    $user->save();

    return redirect()->route('profil')->with('success', 'Data berhasil diperbarui.');
}

public function ChangePass()
{
    $user = Auth::user();
    if ($user->role !== 'customer') {
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }

    return view('customer.ChangePass');
}

public function postChangePass(Request $request)
{
    $request->validate([
        'password' => 'required',
        'new_password' => 'required',
        'confirmation_password' => 'required|same:new_password',
    ]);

    $user = User::where('id', Auth::id())->first();
    if ($user->role !== 'customer') {
        return redirect('/')->with('pesan-gagal', 'Anda tidak memiliki akses ke halaman ini.');
    }

    if (!Hash::check($request->password, $user->password)) {
        return back()->withErrors(['password' => 'Password lama tidak benar.']);
    }
    try {
        $user->password = Hash::make($request->new_password);
        $user->save();
    } catch (\Exception $e) {
        Log::error('Gagal memperbarui password: ' . $e->getMessage());
        return back()->withErrors(['error' => 'Gagal memperbarui password.']);
    }

    return redirect()->route('profil')->with('pesan-berhasil', 'Password berhasil diperbarui.');
}

public function transaksi($id, Tiket $tiket, Request $request)
{
    $event = Event::find($id);
    $tiket = Tiket::where('event_id', $id)->first();
    $user = Auth::user();

    $tiket_dibeli = $request->input('tiket_dibeli');
    $total_harga = $tiket->harga_tiket * $tiket_dibeli;

    \Midtrans\Config::$serverKey = 'SB-Mid-server-CnJxn_ehQltuNunsQNfJRl3m';
    \Midtrans\Config::$isProduction = false;
    \Midtrans\Config::$isSanitized = true;
    \Midtrans\Config::$is3ds = true;

    $params = array(
        'transaction_details' => array(
            'order_id' => rand(),
            'gross_amount' => $total_harga,
        ),
        'customer_details' => [
            'first_name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ],
    );

    $snapToken = \Midtrans\Snap::getSnapToken($params);

    // Format total harga untuk tampilan
    $formatted_total_harga = number_format($total_harga, 0, ',', '.');
    $event = $tiket->event;

    if (!$event) {
        return redirect()->back()->withErrors('Event tidak ditemukan.');
    }

    // Menambahkan logika pengiriman email di sini
    try {
        // Simpan data transaksi di database jika perlu
        // Misalnya, jika ada model Transaksi untuk menyimpan data
        $transaksi = Transaksi::create([
            'event_id' => $id,
            'user_id' => $user->id,
            'tiket_id' => $tiket->id,
            'tiket_dibeli' => $tiket_dibeli,
            'total_harga' => $total_harga,
            'email_pembeli' => $request->input('email'), // Simpan email untuk pengiriman
        ]);

        // Kirim email notifikasi
        Mail::to($request->input('email'))->send(new kirimTiket($transaksi, $tiket));

        // Log pengiriman email
        Log::info('Email berhasil dikirim ke: ' . $request->input('email'));
    } catch (\Exception $e) {
        // Log error jika terjadi masalah saat mengirim email
        Log::error('Gagal mengirim email: ' . $e->getMessage());
    }

    return view('customer.transaksi', compact('event', 'tiket',  'formatted_total_harga', 'tiket_dibeli', 'snapToken', 'user'));
}

public function postKirimTiket(Request $request)
{
    // Validasi request untuk memastikan id_transaksi ada di tabel transaksis
    $request->validate([
        'id_transaksi' => 'required|exists:transaksis,id',
    ]);

    try {
        // Cari transaksi berdasarkan ID
        $transaksi = Transaksi::find($request->id_transaksi);

        // Ambil tiket yang terkait dengan transaksi
        $tiket = Tiket::where('transaksi_id', $transaksi->id)->first();

        // Cek apakah transaksi dan tiket ditemukan
        if ($transaksi && $tiket) {
            // Kirim email ke email pembeli
            Mail::to($transaksi->email)
                ->send(new kirimTiket($transaksi, $tiket));

            return response()->json([
                'status' => 'success',
                'message' => 'Email berhasil dikirim!'
            ]);
        } else {
            // Jika tiket tidak ditemukan, beri respon error
            return response()->json([
                'status' => 'error',
                'message' => 'Tiket atau transaksi tidak ditemukan.'
            ], 404);
        }
    } catch (\Exception $e) {
        // Tangkap error jika proses pengiriman email gagal
        return response()->json([
            'status' => 'error',
            'message' => 'Gagal mengirim email: ' . $e->getMessage()
        ], 500);
    }
}
}
