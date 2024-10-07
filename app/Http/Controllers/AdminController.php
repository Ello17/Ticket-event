<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tiket;
use App\Models\User;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event as FacadesEvent;

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
//     return redirect()->route('homeAdmin')->with('pesan-berhasil','Data Berhasil Dihapus');
// }

function kelolaUser(){
    $user= User::all();
    return view('admin.kelolaUser', compact('user'));
}
public function hapusUser($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('kelolaUser')->with('success', 'Owner deleted successfully.');
}
}
