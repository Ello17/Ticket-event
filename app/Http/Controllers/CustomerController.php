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

    function history() {
        return view('customer.history');
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
            'profil' => 'nullable|image', // Hanya wajib jika ada profil yang di-upload
        ]);

        // Temukan pengguna yang akan diedit
        $user = User::findOrFail($id);

        // Update data pengguna
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Mengenkripsi password

        // Jika ada profil yang di-upload, simpan profil baru
        if ($request->hasFile('profil')) {
            $file = $request->file('profil');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'img/' . $fileName;

            // Log informasi file
            Log::info('File upload: ' . $fileName);
            Log::info('File path: ' . $filePath);

            // Hapus profil lama jika ada
            if ($user->profil && File::exists(public_path($user->profil))) {
                Log::info('Deleting old file: ' . public_path($user->profil));
                File::delete(public_path($user->profil));
            }

            // Simpan profil baru
            $file->move(public_path('img'), $fileName);
            $user->profil = $filePath;
        }

        // Simpan perubahan ke database
        $user->save();

        // Redirect ke halaman profilAdmin dengan ID pengguna
        return redirect()->route('profil', ['user' => $id])->with('success', 'Data berhasil diperbarui.');
    }
}
