<?php

namespace App\Http\Controllers;

use App\Mail\SendTicketMail;
use App\Models\Event;
use App\Models\participant;
use App\Models\Tiket;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CreatorController extends Controller
{
    //

    public function homeCreator()
    {
        $user = Auth::user();
        $event = Event::where('user_id', $user->id)->first();
        $eventCount = Event::where('user_id', $user->id)->count();

        return view('creator.homeCreator', compact('event', 'eventCount'));
    }


    public function kelolaEvent(Request $request)
    {
        $user = Auth::user();
        $search = $request->input('search');
        $events = Event::where('user_id', $user->id)
            ->when($search, function ($query, $search) {
                return $query->where('nama_event', 'like', "%{$search}%");
            })
            ->paginate(10);
        $events->appends(['search' => $search]);
        $event = Event::where('user_id', $user->id)->first();

        return view('creator.kelolaEvent', compact('events', 'search', 'event'));
    }


    public function tambahEvent()
    {
        return view('creator.tambahEvent');
    }

    public function postTambahEvent(Request $request)
    {
        $request->validate([
            'nama_event' => 'required|string|max:255',
            'nama_penyelenggara' => 'required|string|max:255',
            'lokasi_event' => 'required|string|max:255',
            'tanggal_event' => 'required|date|after_or_equal:today',
            'waktu_event' => 'required|date_format:H:i',
            'deskripsi_event' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'maps' => 'required|url',
            'cover_event' => 'required|image|mimes:jpeg,png,jpg|max:15360',
        ]);

        $imagePath = $request->file('cover_event')->store('images', 'public');

        Event::create([
            'user_id' => Auth::id(),
            'nama_event' => $request->nama_event,
            'nama_penyelenggara' => $request->nama_penyelenggara,
            'lokasi_event' => $request->lokasi_event,
            'tanggal_event' => $request->tanggal_event,
            'waktu_event' => $request->waktu_event,
            'maps' => $request->maps,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'deskripsi_event' => $request->deskripsi_event,
            'cover_event' => $imagePath,
        ]);

        return redirect()->route('kelolaEvent')->with('pesan-berhasil', 'Event Berhasil Ditambahkan');
    }

  public function editEvent($id){
    $event = Event::findOrFail($id);
    return view('creator.editEvent', compact('event'));
  }

    public function postEditEvent(Request $request, $id)
    {
        $request->validate([
            'cover_event' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama_event' => 'required|string|max:255',
            'nama_penyelenggara' => 'required|string|max:255',
            'tanggal_event' => 'required|date|after_or_equal:today',
            'waktu_event' => 'required|date_format:H:i',
            'lokasi_event' => 'required|string|max:255',
            'maps' => 'required|url',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'deskripsi_event' => 'required|string',
        ]);

        $event = Event::findOrFail($id);

        try {
            if ($request->hasFile('cover_event')) {
                if ($event->cover_event) {
                    Storage::delete($event->cover_event);
                }
                $filePath = $request->file('cover_event')->store('covers', 'public');
                $event->cover_event = $filePath;
            }

            $event->update($request->except('cover_event'));

            return redirect()->route('kelolaEvent')->with('pesan-berhasil', 'Data Berhasil Diedit');
        } catch (\Exception $e) {
            return back()->withErrors(['upload_error' => 'Terjadi kesalahan saat mengupload gambar: ' . $e->getMessage()]);
        }
    }


    public function hapusEvent($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('kelolaEvent')->with('pesan-berhasil', 'Event dan tiket terkait berhasil dihapus');
    }

    public function kelolaTiket()
    {
        $events = Event::with('tiket')->where('user_id', Auth::id())->get();
        return view('creator.kelolaTiket', compact('events'));
    }




    public function tambahtiket($event_id)
    {
        return view('creator.tambahtiket', compact('event_id'));
    }



    public function posttambahtiket(Request $request)
{
    $request->validate([
        'event_id' => 'required|exists:events,id',
        'kategori_tiket' => 'required',
        'harga_tiket' => 'required|numeric',
        'jumlah_tiket' => 'required|integer',
        'link_tiket' => 'nullable|string',
    ]);

    dd($request->all());

    Tiket::create([
        'event_id' => $request->event_id,
        'kategori_tiket' => $request->kategori_tiket,
        'harga_tiket' => $request->harga_tiket,
        'jumlah_tiket' => $request->jumlah_tiket,
        'link_tiket' => $request->link_tiket ?: '-',
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
        Tiket::create($validatedData);
        return redirect()->route('kelolaTiket')->with('success', 'Tiket berhasil ditambahkan.');
    }
    public function editTiket($id)
    {
        $tiket = Tiket::findOrFail($id);
        return view('creator.editTiket', compact('tiket'));
    }

    public function postEditTiket(Request $request, $id)
    {
        $request->validate([
            'kategori_tiket' => 'required|string|max:255',
            'harga_tiket' => 'required|numeric|min:0',
            'jumlah_tiket' => 'required|integer|min:0',
            'link_tiket' => 'nullable|string|min:0',
        ]);

        $tiket = Tiket::findOrFail($id);

        $tiket->kategori_tiket = $request->kategori_tiket;
        $tiket->harga_tiket = $request->harga_tiket;
        $tiket->jumlah_tiket = $request->jumlah_tiket;
        $tiket->link_tiket = $request->link_tiket ?? null;

        $tiket->save();

        return redirect()->route('kelolaTiket')
            ->with('pesan-berhasil', 'Data Berhasil Diedit');
    }

    public function hapusTiket($id)
    {
        $tiket = Tiket::find($id);

        if ($tiket) {
            // Hapus data transaksi terkait
            $tiket->transaksis()->delete();

            // Hapus tiket
            $tiket->delete();

            return redirect()->back()->with('pesan-berhasil', 'Tiket berhasil dihapus!');
        } else {
            return redirect()->back()->with('pesan-gagal', 'Tiket tidak ditemukan!');
        }
    }




    public function editProfileCreator($id)
    {
        $user = Auth::user();
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

        $user = User::where('id', Auth::id())->first();
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
        if ($user->role !== 'creator') {
            return redirect('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        return view('creator.profilCreator', compact('user'));
    }
    public function ubahpass()
    {
        $user = Auth::user();
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

        $user = User::where('id', Auth::id())->first();
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

    public function grafik($user_id = null)
    {
        if (!$user_id) {
            return redirect()->route('some.default.route');
        }

        $now = Carbon::now();
        $currentYear = $now->year;
        $months = collect(range(1, 12))->map(function ($month) use ($currentYear) {
            return Carbon::create($currentYear, $month, 1)->format('F Y');
        });
        $transaksis = Transaksi::with(['tiket.event'])
            ->whereYear('tanggal_transaksi', $currentYear)
            ->whereHas('tiket.event', function ($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->get();
        $grouped = $transaksis->groupBy(function ($item) {
            return Carbon::parse($item->tanggal_transaksi)->format('F Y');
        });
        $labels = $months->toArray();
        $jumlahTiket = $months->map(function ($month) use ($grouped) {
            return isset($grouped[$month]) ? $grouped[$month]->sum('tiket_dibeli') : 0;
        })->toArray();
        if ($transaksis->isEmpty()) {
            return view('creator.grafik', [
                'transaksis' => $transaksis,
                'labels' => [],
                'jumlahTiket' => [],
                'message' => "Tidak ada transaksi yang cocok untuk tahun ini dan user_id ini."
            ]);
        }
        return view('creator.grafik', [
            'transaksis' => $transaksis,
            'labels' => $labels,
            'jumlahTiket' => $jumlahTiket,
        ]);
    }


    public function ScanQr()
{
    // $event = Event::find($eventId);


    // if (!$event) {
    //     return redirect()->back()->with('error', 'Event tidak ditemukan.');
    // }
    return view('creator.scanqr');
}


public function postScanQr(Request $request)
{
    $request->validate([
        'kode_result' => 'required|string',
    ]);

    $kodeTiket = $request->kode_result;

    $participant = Participant::where('kode_tiket', $kodeTiket)->first();

    if (!$participant) {
        return back()->with('scan-gagal', 'Kode tiket tidak ditemukan, scan gagal diproses.');
    }
    $auth = Auth::user();

    if ($auth->id!= $participant->event->user_id) {
        return back()->with('scan-gagal', 'Anda bukan pemilik tiket ini.');
    }

    $eventName = $participant->event->nama_event;

    if ($participant->is_present) {
        return back()->with('scan-warning', 'Tiket sudah digunakan, peserta sudah hadir.');
    }

    $participant->is_present = true;
    $participant->scan_time = now();
    $participant->save();

    return back()->with('scan-berhasil', "Peserta berhasil dipindai untuk event : $eventName.");
}


public function participants(Request $request)
{
    $user = auth()->user();

    $participants = Participant::with(['user', 'event'])
        ->whereHas('event', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->whereHas('transaksi', function ($query) {
            $query->where('status', 'paid');
        })
        ->paginate(10);

    return view('creator.participants', compact('participants'));
}


}
