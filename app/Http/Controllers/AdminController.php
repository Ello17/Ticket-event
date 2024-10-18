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
    function homeAdmin()
    {
        $jumlahEvent = Event::count();
        $jumlahCreator = User::where('role', 'creator')->count();
        $jumlahCustomer = User::where('role', 'customer')->count();

        return view('admin.homeAdmin', compact('jumlahCustomer', 'jumlahCreator', 'jumlahEvent'));
    }

    function listEventAdm(Request $request)
    {
        $search = $request->input('search');

        $events = Event::query()
            ->when($search, function ($query, $search) {
                return $query->where('nama_event', 'like', "%{$search}%")
                    ->orWhere('lokasi_event', 'like', "%{$search}%")
                    ->orWhere('deskripsi_event', 'like', "%{$search}%");
            })
            ->paginate(10); // Change the number according to your need

        return view('admin.kelolaEvent', compact('events', 'search'));
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

            return redirect()->route('listEventAdm')->with('pesan-berhasil', 'Data Berhasil Diedit');
        } catch (\Exception $e) {
            return back()->withErrors(['upload_error' => 'Terjadi kesalahan saat mengupload gambar: ' . $e->getMessage()]);
        }
    }


    public function hapusList(Event $event, Request $request)
    {

        $event->delete();

        return redirect()->route('listEventAdm')->with('pesan-berhasil', 'Event dan tiket terkait berhasil dihapus');
    }

    public function hapusCustomer(User $user, Request $request)
    {
        $user->delete();

        return redirect()->route('kelolaCustomer')->with('pesan-berhasil', 'Data berhasil dihapus');
    }

    public function hapusKreator(User $user, Request $request)
    {
        $user->delete();

        return redirect()->route('kelolaKreator')->with('pesan-berhasil', 'Data berhasil dihapus');
    }




    public function kelolaCustomer(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->where('role', 'customer') // Pastikan hanya pelanggan yang diambil
            ->when($search, function ($query, $search) {
                return $query->where('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10); // Sesuaikan jumlah item per halaman sesuai kebutuhan

        return view('admin.kelolaCustomer', compact('users', 'search'));
    }

    public function kelolaKreator(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->where('role', 'creator') // Pastikan hanya pelanggan yang diambil
            ->when($search, function ($query, $search) {
                return $query->where('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10); // Sesuaikan jumlah item per halaman sesuai kebutuhan

        return view('admin.kelolaKreator', compact('users', 'search'));
    }

    public function hapusUser(user $user, Request $request)
    {
        $user->delete();

        return redirect()->route('kelolaUser')->with('pesan-berhasil', 'Data Berhasil Dihapus');
    }

    public function showPendingUsers(Request $request)
    {
        $search = $request->input('search');
    
        $pendingUsers = User::query()
            ->where('is_approved', false) // Hanya ambil pengguna yang belum disetujui
            ->where('role', 'creator') // Ambil pengguna dengan role 'creator'
            ->when($search, function ($query, $search) {
                // Tambahkan kondisi pencarian pada username dan email
                return $query->where(function ($query) use ($search) {
                    $query->where('username', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->paginate(10); // Sesuaikan jumlah item per halaman sesuai kebutuhan
    
        return view('admin.approveCreator', compact('pendingUsers', 'search'));
    }
    



    public function approveUser($id)
    {
        $user = User::find($id);
        $user->is_approved = true;
        $user->save();

        return redirect()->route('pending.users')->with('pesan-berhasil', 'Pengguna berhasil disetujui.');
    }
}
