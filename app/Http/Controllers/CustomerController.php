<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tiket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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

    public function profil()
{
    // Mengambil data pengguna yang sedang login
    $id = Auth::user()->id;
        $user = User::findOrFail($id);
        return view('customer.profil', compact('user'));
    }
    function editProfileCust($id){
        $user = User::findOrFail($id);
        return view('customer.editProfileCust',compact('user'));
    }
    public function postEditProfileCust(Request $request)
    {
            // Validasi input
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'profil' => 'nullable|image', // Hanya wajib jika ada profil yang di-upload
        ]);

        // Temukan pengguna yang akan diedit
        $id = Auth::user()->id;
        $user = User::findOrFail($id);

        // Update data pengguna
        $user->username = $request->username;
        $user->email = $request->email;

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
        return redirect()->route('profil')->with('success', 'Data berhasil diperbarui.');
    }
    public function ChangePass(){
        return view('customer.ChangePass');
    }

    public function postChangePass(Request $request)
    {
        // Validasi input
        $request->validate([
            'password' => 'required',
            'new_password' => 'required',
            'confirmation_password' => 'required',
        ]);

        // Ambil pengguna yang terautentikasi
        $user = Auth::user();

        // Cek jika user terautentikasi
        if (!$user) {
            return back()->withErrors(['error' => 'User tidak ditemukan.']);
        }

        // Periksa apakah password lama benar
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password lama tidak benar.']);
        }

        try {
            // Update password baru
            $user->password = Hash::make($request->new_password);
            $user->save();
        } catch (\Exception $e) {
            // Log error dan tampilkan pesan kesalahan
            Log::error('Gagal memperbarui password: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Gagal memperbarui password.']);
        }

        // Redirect ke halaman profil dengan status sukses
        return redirect()->route('profil')->with('status', 'Password berhasil diperbarui.');
    }


}
