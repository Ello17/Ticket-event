<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tiket;
use App\Models\User;
use Closure;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event as FacadesEvent;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function homeAdmin(){
        $events= Event::with('tiket')->get();
        return view('admin.homeAdmin', compact('events'));

    }
//     public function editList($id)
// {
//     $events = Event::findOrFail($id);
//     return view('admin.editList', compact('events'));
// }

// public function posteditlist(Request $request, $id)
// {
//     $request->validate([
//         'nama_penyelenggara' => 'required',
//         'nama_event' => 'required',
//         'tanggal_event' => 'required',
//         'waktu_event' => 'required',
//         'lokasi_event' => 'required',
//         'deskripsi_event' => 'required',
//     ]);

//     $events = Event::findOrFail($id);
//     $events->update($request->all());

//     return redirect()->route('homeAdmin')->with('pesan-berhasil', 'Data Berhasil Diedit');
// }

// public function hapusList(Event $event, Request $request)
// {
//     return redirect()->route('homeAdmin')->with('notifikasi','Data Berhasil Dihapus');
// }


function kelolaCustomer(){
    $user= User::where('role','customer')->get();
    return view('admin.kelolaCustomer', compact('user'));
}
function kelolaKreator(){
    $user= User::where('role','creator')->get();
    return view('admin.kelolaKreator', compact('user'));
}
public function hapusUser(user $user, Request $request){
    $user->delete();

    return redirect()->route('kelolaUser')->with('pesan-berhasil','Data Berhasil Dihapus');
    }

    // protected function create(array $data)
    // {
    // return User::create([
    // 'name' => $data['name'],
    // 'email' => $data['email'],
    // 'password' => Hash::make($data['password']),
    // 'is_approved' => false, // Set defaultnya ke false
    // ]);
    // }

    // public function handle($request, Closure $next)
    // {
    // if (auth()->check() && !auth()->user()->is_approved) {
    // auth()->logout();
    // return redirect()->route('loginCreator')->withErrors([
    //     'approval' => 'Akun Anda belum disetujui oleh admin.',
    // ]);
    // }

    // return $next($request);
    // }

    public function showPendingUsers()
    {
    $pendingUsers = User::where('is_approved', false)->get();
    return view('admin.approveCreator', compact('pendingUsers'));
    }

    public function approveUser($id)
    {
    $user = User::find($id);
    $user->is_approved = true;
    $user->save();

    return redirect()->route('pending.users')->with('pesan-berhasil', 'Pengguna berhasil disetujui.');
    }




}
