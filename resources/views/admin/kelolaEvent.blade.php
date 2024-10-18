@extends('layouts.appAdmin')
@section('title', 'Home Admin - Tiket Mudah')
@section('content')
    <div class="card bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="card-header p-4">
            <h5 class="text-lg font-semibold">Tabel List Event</h5>
        </div>
        <div class="card-body p-4">
            <!-- Search Form -->
            <form method="GET" action="{{ route('listEventAdm') }}" class="mb-4">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..." class="border rounded px-2 py-1">
                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded"><i class="ri-search-2-line"></i></button>
            </form>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white table-auto border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">No</th>
                            <th class="border p-2">Cover</th>
                            <th class="border p-2">Nama Event</th>
                            <th class="border p-2">Waktu</th>
                            <th class="border p-2">Lokasi Event</th>
                            <th class="border p-2">Deskripsi Event</th>
                            <th class="border p-2">Harga</th>
                            <th class="border p-2">Kategori</th>
                            <th class="border p-2">Tiket</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $e)
                            <tr>
                                <td class="border p-2">{{ $loop->iteration + ($events->currentPage() - 1) * $events->perPage() }}</td>
                                <td class="border p-2"><img src="{{ asset($e->cover_event) }}" alt="Cover Event"
                                        class="w-24"></td>
                                <td class="border p-2">{{ $e->nama_event }}</td>
                                <td class="border p-2">
                                    <span>{{ $e->tanggal_event }}</span>
                                    <span>{{ $e->waktu_event }}</span>
                                </td>
                                <td class="border p-2">{{ $e->lokasi_event }}</td>
                                <td class="border p-2" title="{{ $e->deskripsi_event }}">
                                    {{ \Illuminate\Support\Str::limit($e->deskripsi_event, 50) }}</td>

                                @if ($e->tiket->isNotEmpty())
                                    <td class="border p-2">{{ $e->tiket->first()->harga_tiket }}</td>
                                    <td class="border p-2">{{ $e->tiket->first()->kategori_tiket }}</td>
                                    <td class="border p-2">{{ $e->tiket->first()->jumlah_tiket }}</td>
                                @else
                                    <td class="border p-2" colspan="3">Tidak ada tiket</td>
                                @endif
                                <td class="border p-2">
                                    <div class="flex text-center space-x-2">
                                        <a href="{{ route('admin.editList', $e->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded text-sm">Edit</a>
                                        <a href="{{ route('hapusList', $e->id) }}"
                                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-sm"
                                            onclick="return confirm('Are you sure?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $events->appends(['search' => request('search')])->links() }}
            </div>
        </div>
    </div>
@endsection
