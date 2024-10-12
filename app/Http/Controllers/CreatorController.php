<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CreatorController extends Controller
{
    //

    public function homeCreator()
    {
        $user = Auth::user(); 
        $events = Event::where('user_id', $user->id)->get(); 
        
        return view('creator.homeCreator', compact('events'));
    }

    public function tambahEvent(){
        return view('creator.tambahEvent');
    }

    public function postTambahEvent(Request $request){
        $request->validate([
           'nama_event' => 'required',
           'nama_penyelenggara' => 'required',
           'lokasi_event' => 'required',
           'tanggal_event' => 'required',
           'waktu_event' => 'required',
           'deskripsi_event' => 'required',
           'cover_event' =>'required|image|mimes:jpeg,png,jpg|max:2048',
           
        ]);
    
        $imagePath = $request->file('cover_event')->store('images', 'public');
    
        Event::create([
            'user_id' => Auth::id(),
           'nama_event' => $request->nama_event,
           'nama_penyelenggara'=>$request->nama_penyelenggara,
           'lokasi_event'=>$request->lokasi_event,
           'tanggal_event'=>$request->tanggal_event,
           'waktu_event'=> $request->waktu_event,
           'deskripsi_event'=>$request->deskripsi_event,
           'cover_event'=>$imagePath,
           
        ]);

        return redirect()->route('homeCreator')->with('pesan-berhasil','Event Berhasil Ditambahkan');
    }

  public function editEvent(Event $event){
    return view('creator.editEvent', compact('event'));
  }

  public function postEditEvent(Event $event, Request $request){
    $data = $request->validate([
           'nama_event' => 'required',
           'nama_penyelenggara' => 'required',
           'lokasi_event' => 'required',
           'tanggal_event' => 'required',
           'waktu_event' => 'required',
           'deskripsi_event' => 'required',
        
    ]);
    if ($request->hasFile('cover_event')) {
      if ($event->cover_event) {
          Storage::delete($event->cover_event);
      }
      $data['cover_event'] = $request->file('cover_event')->store('images');
  }
    $event->update($data);
    return redirect()->route('homeCreator')->with('pesan-berhasil','Event Berhasil Diubah!!');

  }

  public function hapusEvent(Event $request, $id)
  {
    $event = $request;
    $event->delete();
    return redirect()->route('homeCreator')->with('pesan-berhasil','Event Berhasil Dihapus!!');
  }

}
