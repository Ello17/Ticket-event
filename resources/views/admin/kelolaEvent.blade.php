@extends('layouts.appAdmin')
@push('css')
@endpush
@section('title', 'Home Admin - Tiket Mudah')
@section('content')

<div class="content ml-64 p-8">
    <div class="card bg-white shadow-lg rounded-lg">
        <div class="card-header p-4">
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

                            @if($e->tiket->isNotEmpty())
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
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
@endpush

