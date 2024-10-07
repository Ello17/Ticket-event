<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tiket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;


class CustomerController extends Controller
{
    //

    function homeCustomer(){
        $data= Event::all();
        return view('customer.homeCustomer', compact('data'));

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

    public function profil($id)
{

    // Mengambil data pengguna yang sedang login
        $user = User::findOrFail($id);
        return view('customer.profil', compact('user'));
    }
    function editProfileCust($id){
        $user = User::findOrFail($id);
        return view('customer.editProfileCust',compact('user'));
    }
    public function postEditProfileCust(Request $request, $id)
    {
            // Validasi input
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'gambar' => 'nullable|image', // Hanya wajib jika ada gambar yang di-upload
        ]);

        // Temukan pengguna yang akan diedit
        $user = User::findOrFail($id);

        // Update data pengguna
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Mengenkripsi password

        // Jika ada gambar yang di-upload, simpan gambar baru
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'img/' . $fileName;

            // Log informasi file
            Log::info('File upload: ' . $fileName);
            Log::info('File path: ' . $filePath);

            // Hapus gambar lama jika ada
            if ($user->gambar && File::exists(public_path($user->gambar))) {
                Log::info('Deleting old file: ' . public_path($user->gambar));
                File::delete(public_path($user->gambar));
            }

            // Simpan gambar baru
            $file->move(public_path('img'), $fileName);
            $user->gambar = $filePath;
        }

        // Simpan perubahan ke database
        $user->save();

        // Redirect ke halaman profilAdmin dengan ID pengguna
        return redirect()->route('profil', ['user' => $id])->with('success', 'Data berhasil diperbarui.');
    }
}
