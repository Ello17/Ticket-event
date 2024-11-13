<?php

namespace App\Http\Controllers;

use App\Mail\SendTicketMail;
use App\Models\Event;
use App\Models\participant;
use App\Models\Tiket;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
// use Facade\FlareClient\Stacktrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        // Mengambil event milik user dan menghitung jumlahnya
        $events = Event::where('user_id', $user->id)->get();
        $eventCount = $events->count();

        return view('creator.homeCreator', compact('events', 'eventCount'));
    }

    public function kelolaEvent(Request $request)
    {
        $user = Auth::user();

        // Mengambil input pencarian (jika ada)
        $search = $request->input('search');

        // Query event milik user dengan pencarian dan pagination
        $events = Event::where('user_id', $user->id)
            ->when($search, function ($query, $search) {
                return $query->where('nama_event', 'like', "%{$search}%");
            })
            ->paginate(10);

        // Menambahkan parameter pencarian ke pagination link
        $events->appends(['search' => $search]);

        return view('creator.kelolaEvent', compact('events', 'search'));
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

            // Update the other fields except 'cover_event'
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
        ]);

        $tiket = Tiket::findOrFail($id);

        $tiket->kategori_tiket = $request->kategori_tiket;
        $tiket->harga_tiket = $request->harga_tiket;
        $tiket->jumlah_tiket = $request->jumlah_tiket;

        $tiket->save();

        return redirect()->route('kelolaTiket')
            ->with('pesan-berhasil', 'Data Berhasil Diedit');
    }

    public function hapusTiket($id)
    {
        $tiket = Tiket::find($id);

        if ($tiket) {
            $tiket->delete();
            return redirect()->back()->with('pesan-berhasil', 'Tiket berhasil dihapus!');
        } else {
            return redirect()->back()->with('pesan-gagal', 'Tiket tidak ditemukan!');
        }
    }


    // public function kirimTiket(Request $request, $eventId)
    // {
    //     $event = Event::findOrFail($eventId);
    //     $customer = User::where('email', $request->input('customer_email'))->first();

    //     if (!$customer) {
    //         return redirect()->back()->with('error', 'Customer tidak ditemukan');
    //     }
    //     $tiket = Tiket::where('event_id', $eventId)->first();

    //     if (!$tiket) {
    //         return redirect()->back()->with('error', 'Tiket tidak tersedia untuk event ini');
    //     }
    //     Mail::to($customer->email)->send(new SendTicketMail($event, $tiket, $customer));

    //     return redirect()->back()->with('success', 'Tiket telah dikirim ke email customer!');
    // }
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

    public function grafik()
    {
        $now = Carbon::now();
        $transaksis = Transaksi::with(['tiket'])
            ->whereMonth('tanggal_transaksi', $now->month)
            ->whereYear('tanggal_transaksi', $now->year)
            ->get();


        $labels = $transaksis->groupBy(function ($item) {
            return Carbon::parse($item->tanggal_transaksi)->format('F Y');
        })->keys()->toArray();

        $jumlahTiket = $transaksis->groupBy(function ($item) {
            return Carbon::parse($item->tanggal_transaksi)->format('F Y');
        })->map(function ($items) {
            return $items->sum('tiket_dibeli');
        })->toArray();


        return view('creator.grafik', [
            'transaksis' => $transaksis,
            'labels' => $labels,
            'jumlahTiket' => $jumlahTiket,
        ]);
    }
    public function scanQr()
    {
        return view('creator.scanqr');
    }
    public function postScanQr(Request $request)
    {
        // Ambil kode_tiket dari form
        $kodeTiket = $request->input('kode_tiket');
        Log::info('Nilai input kode_tiket: ' . $kodeTiket);
    
        if (!$kodeTiket) {
            Log::error('Kode tiket tidak ditemukan dalam input.');
            return back()->with('error', 'Kode tiket tidak ditemukan dalam input.');
        }
    
        // Cek apakah tiket sudah discan sebelumnya di tabel participant
        $existingParticipant = Participant::where('kode_tiket', $kodeTiket)->first();
        if ($existingParticipant) {
            Log::info('Tiket sudah pernah discan sebelumnya: ' . $kodeTiket);
            return back()->with('error', 'Tiket sudah discan sebelumnya!');
        }
    
        // Cari data transaksi berdasarkan kode_tiket
        $transaksi = Transaksi::where('kode_tiket', $kodeTiket)->first();
        if (!$transaksi) {
            Log::warning('Data transaksi tidak ditemukan untuk kode_tiket: ' . $kodeTiket);
            return back()->with('error', 'Kode tiket tidak ditemukan!');
        }
    
        // Simpan data ke tabel participant
        try {
            $participant = Participant::create([
                'user_id' => $transaksi->user_id,
                'event_id' => $transaksi->event_id,
                'tiket_id' => $transaksi->id,
                'kode_tiket' => $transaksi->kode_tiket,
                'scan_time' => now(),
                'is_present' => true,
            ]);
    
            Log::info('Data Participant berhasil disimpan.', $participant->toArray());
    
            // Notifikasi sukses
            return back()->with('success', 'Tiket berhasil discan dan disimpan sebagai hadir.');
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan data Participant: ' . $e->getMessage());
            Log::error('Trace Error: ' . $e->getTraceAsString());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data.');
        }
    }
       
}