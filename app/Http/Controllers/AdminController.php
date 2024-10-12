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
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    function homeAdmin(){
        $jumlahEvent = Event::count();
        $jumlahCreator = User::where('role', 'creator')->count();
        $jumlahCustomer = User::where('role', 'customer')->count();

        return view('admin.homeAdmin', compact('jumlahCustomer', 'jumlahCreator', 'jumlahEvent'));
    }

    function listEventAdm(){
        $events= Event::with('tiket')->get();
        return view('admin.kelolaEvent', compact('events'));
    }
    public function editList($id)
{
    $events = Event::findOrFail($id);
    return view('admin.editList', compact('events'));
}

public function posteditlist(Request $request, $id)
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

        return redirect()->route('listEvent')->with('pesan-berhasil', 'Data Berhasil Diedit');
    } catch (\Exception $e) {
        return back()->withErrors(['upload_error' => 'Terjadi kesalahan saat mengupload gambar: ' . $e->getMessage()]);
    }
}


public function hapusList(Event $event, Request $request)
{

    $event->delete();

    return redirect()->route('listEventAdm')->with('pesan-berhasil', 'Event dan tiket terkait berhasil dihapus');
}

public function hapusCustomer( User $user, Request $request)
{
    $user->delete();

    return redirect()->route('kelolaCustomer')->with('pesan-berhasil', 'Data berhasil dihapus');
}

public function hapusKreator( User $user, Request $request)
{
    $user->delete();

    return redirect()->route('kelolaKreator')->with('pesan-berhasil', 'Data berhasil dihapus');
}




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
        $pendingUsers = User::where('is_approved', false)
                            ->where('role', 'creator')
                            ->get();
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
