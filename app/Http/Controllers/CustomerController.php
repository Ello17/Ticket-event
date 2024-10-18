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

    $user = Auth::user();
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

    $user = Auth::user();
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


}
