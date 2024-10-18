<?php

namespace App\Http\Controllers;

use App\Mail\SendTicketMail;
use App\Models\Event;
use App\Models\Tiket;
use App\Models\User;
// use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

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


public function hapusEvent($id)
{
    $event = Event::findOrFail($id);
    $event->delete();

    return redirect()->route('homeCreator')->with('pesan-berhasil', 'Event dan tiket terkait berhasil dihapus');
}

  public function kelolaTiket()
  {
      // Ambil event milik creator yang login berdasarkan user_id
      $events = Event::with('tiket')->where('user_id', Auth::id())->get();

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
public function editTiket($id){
    $tiket = Tiket::findOrFail($id);
    return view('creator.editTiket', compact('tiket'));
  }

  public function postEditTiket(Request $request, $id)
  {
      // Validasi input dari request
      $request->validate([
          'kategori_tiket' => 'required|string|max:255',
          'harga_tiket' => 'required|numeric|min:0',
          'jumlah_tiket' => 'required|integer|min:0',
      ]);

      $tiket = Tiket::findOrFail($id);

      $tiket->kategori_tiket = $request->kategori_tiket;
      $tiket->harga_tiket = $request->harga_tiket;
      $tiket->jumlah_tiket = $request->jumlah_tiket;

      $tiket->save();

      return redirect()->route('kelolaTiket')
                       ->with('pesan-berhasil', 'Data Berhasil Diedit');
  }
//   public function hapusTiket(Tiket $request, $id)
//   {
//     $tiket = $request;
//     $tiket->delete();
//     return redirect()->route('kelolaTiket')->with('pesan-berhasil','Tiket Berhasil Dihapus!!');
//   }
public function hapusTiket($id)
{
    $tiket = Tiket::find($id);

    if ($tiket) {
        $tiket->delete();
        return redirect()->back()->with('success', 'Tiket berhasil dihapus!');
    } else {
        return redirect()->back()->with('error', 'Tiket tidak ditemukan!');
    }
}



public function kirimTiket(Request $request, $eventId)
{
    $event = Event::findOrFail($eventId);
    $customer = User::where('email', $request->input('customer_email'))->first();

    if (!$customer) {
        return redirect()->back()->with('error', 'Customer tidak ditemukan');
    }

    // Ambil tiket dari event
    $tiket = Tiket::where('event_id', $eventId)->first();

    if (!$tiket) {
        return redirect()->back()->with('error', 'Tiket tidak tersedia untuk event ini');
    }

    // Kirim email tiket ke customer
    Mail::to($customer->email)->send(new SendTicketMail($event, $tiket, $customer));

    return redirect()->back()->with('success', 'Tiket telah dikirim ke email customer!');
}
public function editProfileCreator($id)
{
    $user = Auth::user();

    // Pastikan hanya customer yang bisa mengedit profil
    if ($user->role !== 'creator' || $user->id != $id) {
        return redirect('/')->with('error', 'Anda tidak diizinkan mengakses halaman ini.');
    }

    return view('creator.editProfileCreator', compact('user'));
}
public function postEditProfileCreator(Request $request)
{
    $request->validate([
        'username' => 'required',
        'email' => 'required',
        'profil' => 'nullable|image',
    ]);

    $user = Auth::user();

    // Pastikan hanya customer yang bisa mengupdate profil
    if ($user->role !== 'creator') {
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

    return redirect()->route('profilCreator')->with('success', 'Data berhasil diperbarui.');
}
public function profilCreator()
{
    $user = Auth::user();

    // Memastikan hanya pengguna dengan role 'customer' yang bisa mengakses
    if ($user->role !== 'creator') {
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }

    return view('creator.profilCreator', compact('user'));
}
public function ubahpass()
{
    $user = Auth::user();

    // Pastikan hanya customer yang bisa mengganti password
    if ($user->role !== 'creator') {
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }

    return view('creator.ubahpass');
}

public function postubahpass(Request $request)
{
    $request->validate([
        'password' => 'required',
        'new_password' => 'required',
        'confirmation_password' => 'required|same:new_password',
    ]);

    $user = Auth::user();

    // Pastikan hanya customer yang bisa mengganti password
    if ($user->role !== 'creator') {
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
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

    return redirect()->route('profilCreator')->with('status', 'Password berhasil diperbarui.');
}


}
