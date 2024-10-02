<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event as FacadesEvent;

class AdminController extends Controller
{
    function homeAdmin(){
        $events= Event::all();
        return view('admin.homeAdmin', compact('events'));

    }
    public function editList($id)
{
    $events = Event::findOrFail($id);
    return view('admin.editList', compact('events'));
}

public function posteditlist(Request $request, $id)
{
    $request->validate([
        'nama_penyelenggara' => 'required',
        'nama_event' => 'required',
        'tanggal_event' => 'required',
        'waktu_event' => 'required',
        'lokasi_event' => 'required',
        'deskripsi_event' => 'required',
    ]);

    $events = Event::findOrFail($id);
    $events->update($request->all());

    return redirect()->route('homeAdmin')->with('notifikasi', 'Data Berhasil Diedit');
}

public function hapusList($id)
{
    $events = Event::findOrFail($id);
    $events->delete();
    
    return redirect()->route('homeAdmin')->with('notifikasi','Data Berhasil Dihapus');
}

function kelolaUser(){
    $events= Event::all();
    return view('admin.kelolaUser', compact('events'));

}
}
