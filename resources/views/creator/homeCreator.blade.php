@extends('layouts.appCreator')

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
                <table class="min-w-full bg-white border border-gray-200" id="example">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600">
                            <th class="py-2 px-4 border">Poster</th>
                            <th class="py-2 px-4 border">Nama Event</th>
                            <th class="py-2 px-4 border">Nama Penyelenggara</th>
                            <th class="py-2 px-4 border">Lokasi Event</th>
                            <th class="py-2 px-4 border">Tanggal Event</th>
                            <th class="py-2 px-4 border">Waktu Event</th>
                            <th class="py-2 px-4 border">Deskripsi Event</th>
                            <th class="py-2 px-4 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($events as $item)
                            <tr class="border-b">
                                <td class="p-2">
                                    <img src="{{ asset($item->cover_event) }}" alt="Poster Event" class="w-20 h-auto">
                                </td>
                                <td class="p-2">{{ $item->nama_event }}</td>
                                <td class="p-2">{{ $item->nama_penyelenggara }}</td>
                                <td class="p-2">{{ $item->lokasi_event }}</td>
                                <td class="p-2">{{ $item->tanggal_event }}</td>
                                <td class="p-2">{{ $item->waktu_event }}</td>
                                <td class="border p-4" title="{{ $item->deskripsi_event }}">
                                    {{ \Illuminate\Support\Str::limit($item->deskripsi_event, 50) }}
                                </td>
                                <td class="p-2">
                                    <a href="{{ route('hapusEvent', $item->id) }}" class="text-red-500 hover:underline">Delete</a>
                                    <a href="{{ route('editEvent', $item->id) }}" class="text-blue-500 hover:underline">Edit</a>
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
