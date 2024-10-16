@extends('layouts.appAdmin')
@section('title', 'Home Admin - Tiket Mudah')
@section('content')
<h2 class="text-2xl font-bold mb-4">Dashboard</h2>
<p>
    Ini adalah konten utama halaman admin. Sidebar bisa dibuka/ditutup
    pada tampilan mobile.
</p>
<div class="grid grid-cols-1 gap-6 md:grid-cols-3 mt-6">
    <div
      class="bg-blue-500 p-6 rounded-md shadow-md flex justify-between items-center"
    >
      <div>
        <h2 class="text-2xl text-white font-bold">Events</h2>
        <span class="text-white text-xl font-semibold"
          >{{ $jumlahEvent }}</span
        >
      </div>
      <div class="text-4xl text-white">
        <i class="ri-calendar-event-fill"></i>
      </div>
    </div>
    <div
      class="bg-blue-500 p-6 rounded-md shadow-md flex justify-between items-center"
    >
      <div>
        <h2 class="text-2xl text-white font-bold">Creator</h2>
        <span class="text-white text-xl font-semibold"
          >{{ $jumlahCreator }}</span
        >
      </div>
      <div class="text-4xl text-white">
        <i class="ri-user-2-line"></i>
      </div>
    </div>
    <div
      class="bg-blue-500 p-6 rounded-md shadow-md flex justify-between items-center"
    >
      <div>
        <h2 class="text-2xl text-white font-bold">Customer</h2>
        <span class="text-white text-xl font-semibold"
          >{{ $jumlahCustomer }}</span
        >
      </div>
      <div class="text-4xl text-white">
        <i class="ri-user-line"></i>
      </div>
    </div>
  </div>
    {{-- <div class="card-header p-4">
    <h5 class="text-lg font-semibold">Tabel List Event</h5>
</div>
<div class="card-body p-4">
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white table-auto border-collapse border border-gray-200" id="example">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-4">No</th>
                    <th class="border p-4">Cover</th>
                    <th class="border p-4">Nama Penyelenggara</th>
                    <th class="border p-4">Nama Event</th>
                    <th class="border p-4">Tanggal Event</th>
                    <th class="border p-4">Waktu Event</th>
                    <th class="border p-4">Lokasi Event</th>
                    <th class="border p-4">Deskripsi Event</th>
                    <th class="border p-4">Harga</th>
                    <th class="border p-4">Kategori</th>
                    <th class="border p-4">Jumlah Tiket</th>
                    <th class="border p-4">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $e)
                <tr>
                    <td class="border p-4">{{ $loop->iteration }}</td>
                    <td class="border p-4"><img src="{{ asset($e->cover_event) }}" alt="Cover Event" class="w-24"></td>
                    <td class="border p-4">{{ $e->nama_penyelenggara }}</td>
                    <td class="border p-4">{{ $e->nama_event }}</td>
                    <td class="border p-4">{{ $e->tanggal_event }}</td>
                    <td class="border p-4">{{ $e->waktu_event }}</td>
                    <td class="border p-4">{{ $e->lokasi_event }}</td>
                    <td class="border p-4" title="{{ $e->deskripsi_event }}">{{ \Illuminate\Support\Str::limit($e->deskripsi_event, 50) }}</td>

                    @if ($e->tiket->isNotEmpty())
                    <td class="border p-4">{{ $e->tiket->first()->harga_tiket }}</td>
                    <td class="border p-4">{{ $e->tiket->first()->kategori_tiket }}</td>
                    <td class="border p-4">{{ $e->tiket->first()->jumlah_tiket }}</td>
                    @else
                    <td class="border p-4" colspan="3">Tidak ada tiket</td>
                    @endif

                    <td class="border p-4 space-y-2">
                        <a href="{{ route('admin.editList', $e->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <a href="{{ route('hapusList', $e->id) }}" class="text-red-600 hover:underline" onclick="return confirm('Are you sure?')">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div> --}}
@endsection
