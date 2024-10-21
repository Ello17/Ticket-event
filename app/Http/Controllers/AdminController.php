<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Tiket;
use App\Models\User;
use Closure;
// use Facade\FlareClient\Stacktrace\File;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event as FacadesEvent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
            ->paginate(10);

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
            if ($request->hasFile('cover_event')) {
                if ($events->cover_event) {
                    Storage::delete($events->cover_event);
                }
                $filePath = $request->file('cover_event')->store('covers', 'public');
                $events->cover_event = $filePath;
            }
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
            ->where('role', 'customer')
            ->when($search, function ($query, $search) {
                return $query->where('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.kelolaCustomer', compact('users', 'search'));
    }

    public function kelolaKreator(Request $request)
    {
        $search = $request->input('search');

        $users = User::query()
            ->where('role', 'creator')
            ->when($search, function ($query, $search) {
                return $query->where('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->paginate(10);

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
            ->where('is_approved', false)
            ->where('role', 'creator')
            ->when($search, function ($query, $search) {
                return $query->where(function ($query) use ($search) {
                    $query->where('username', 'like', "%{$search}%")
                          ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('admin.approveCreator', compact('pendingUsers', 'search'));
    }




    public function approveUser($id)
    {
        $user = User::find($id);
        $user->is_approved = true;
        $user->save();

        return redirect()->route('pending.users')->with('pesan-berhasil', 'Pengguna berhasil disetujui.');
    }

    public function profileAdmin()
{
    $user = Auth::user();

    // Memastikan hanya pengguna dengan role 'customer' yang bisa mengakses
    if ($user->role !== 'admin') {
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }

    return view('admin.ProfileAdmin', compact('user'));
}

public function editProfileAdmin($id)
{
    $user = Auth::user();
    if ($user->role !== 'admin' || $user->id != $id) {
        return redirect('/')->with('error', 'Anda tidak diizinkan mengakses halaman ini.');
    }

    return view('admin.editProfileAdmin', compact('user'));
}

public function postEditProfileAdmin(Request $request)
{
    $request->validate([
        'username' => 'required',
        'email' => 'required',
        'profil' => 'nullable|image',
    ]);

    $user = Auth::user();
    if ($user->role !== 'admin') {
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

    return redirect()->route('profileAdmin')->with('success', 'Data berhasil diperbarui.');
}

public function ChangePassMin()
{
    $user = Auth::user();

    // Pastikan hanya customer yang bisa mengganti password
    if ($user->role !== 'admin') {
        return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }

    return view('admin.ChangePassMin');
}

public function postChangePassMin(Request $request)
{
    $request->validate([
        'password' => 'required',
        'new_password' => 'required',
        'confirmation_password' => 'required|same:new_password',
    ]);

    $user = Auth::user();

    // Pastikan hanya customer yang bisa mengganti password
    if ($user->role !== 'admin') {
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

    return redirect()->route('profileAdmin')->with('status', 'Password berhasil diperbarui.');
}
}
