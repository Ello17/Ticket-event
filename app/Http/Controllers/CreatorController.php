<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

  public function editEvent($id){
    $event = Event::findOrFail($id);
    return view('creator.editEvent', compact('event'));
  }

//   public function postEditEvent(Event $event, Request $request)
//   {
//       $data = $request->validate([
//           'nama_event' => 'required',
//           'nama_penyelenggara' => 'required',
//           'lokasi_event' => 'required',
//           'tanggal_event' => 'required',
//           'waktu_event' => 'required',
//           'deskripsi_event' => 'required',
//       ]);

//       if ($request->hasFile('cover_event')) {
//           if ($event->cover_event) {
//               Storage::delete($event->cover_event);
//           }
//           $data['cover_event'] = $request->file('cover_event')->store('images');
//           Log::info('Cover event uploaded: ' . $data['cover_event']);
//       }
//       $event->update($data);

//       return redirect()->route('homeCreator')->with('pesan-berhasil', 'Event Berhasil Diubah!!');
//   }
public function postEditEvent(Request $request, $id)
{
    $request->validate([
        'cover_event' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'nama_penyelenggara' => 'required',
        'nama_event' => 'required',
        'tanggal_event' => 'required|date',
        'waktu_event' => 'required',
        'lokasi_event' => 'required',
        'deskripsi_event' => 'required',
    ]);

    $events = Event::findOrFail($id);

    try {
        // Cek apakah ada file cover yang diupload
        if ($request->hasFile('cover_event')) {
            // Hapus cover lama jika ada
            if ($events->cover_event) {
                Storage::delete($events->cover_event);
            }

            // Upload file baru
            $filePath = $request->file('cover_event')->store('covers', 'public');
            $events->cover_event = $filePath; // Simpan path file di database
        }

        // Perbarui semua data kecuali 'cover' jika tidak ada yang diupload
        $events->update($request->except('cover_event'));

        return redirect()->route('homeCreator')->with('pesan-berhasil', 'Data Berhasil Diedit');
    } catch (\Exception $e) {
        return back()->withErrors(['upload_error' => 'Terjadi kesalahan saat mengupload gambar: ' . $e->getMessage()]);
    }
}



  public function hapusEvent(Event $request, $id)
  {
    $event = $request;
    $event->delete();
    return redirect()->route('homeCreator')->with('pesan-berhasil','Event Berhasil Dihapus!!');
  }

  public function kelolaTiket()
  {
      // Ambil event milik creator yang login berdasarkan user_id
      $events = Event::with('tikets')->where('user_id', Auth::id())->get();

      // Kirim data events ke view
      return view('creator.kelolaTiket', compact('events'));
  }




public function tambahtiket($event_id)
{
    // Kirim event_id ke view
    return view('creator.tambahtiket', compact('event_id'));
}



public function posttambahtiket(Request $request)
{
    $request->validate([
        'event_id' => 'required|exists:events,id',
        'kategori_tiket' => 'required',
        'harga_tiket' => 'required|numeric',
        'jumlah_tiket' => 'required|integer',
    ]);

    Tiket::create([
        'event_id' => $request->event_id,
        'kategori_tiket' => $request->kategori_tiket,
        'harga_tiket' => $request->harga_tiket,
        'jumlah_tiket' => $request->jumlah_tiket,
    ]);

    return redirect()->route('kelolaTiket')->with('pesan-berhasil', 'Tiket Berhasil Ditambahkan');
}

public function storeTicket(Request $request)
{
    $validatedData = $request->validate([
        'event_id' => 'required|exists:events,id',
        'kategori_tiket' => 'required|string|max:255',
        'harga_tiket' => 'required|numeric',
        'jumlah_tiket' => 'required|integer',
    ]);

    // Simpan tiket ke database
    Tiket::create($validatedData);

    // Redirect atau memberikan respon sesuai kebutuhan
    return redirect()->route('kelolaTiket')->with('success', 'Tiket berhasil ditambahkan.');
}


}
