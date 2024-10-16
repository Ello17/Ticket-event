@extends('layouts.appCreator')

@push('css')
@endpush

@section('title', 'Kelola Tiket - Tiket Mudah')

@section('content')
<div class="content ml-64 p-8">
    <div class="card bg-white shadow-lg rounded-lg">
        <div class="card-header p-4">
            <h5 class="text-lg font-semibold">Tabel List Tiket</h5>
        </div>
        <div class="card-body p-4">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200" id="example">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600">
                            <th class="py-2 px-4 border">Poster</th>
                            <th class="py-2 px-4 border">Nama Event</th>
                            <th class="py-2 px-4 border">Kategori Tiket</th>
                            <th class="py-2 px-4 border">Harga</th>
                            <th class="py-2 px-4 border">Jumlah Tiket</th>
                            <th class="py-2 px-4 border">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach ($events as $item)
                            <tr class="border-b">
                                <td class="p-2">
                                    <img src="{{ asset($item->cover_event) }}"
                                         alt="Poster Event"
                                         class="w-20 h-auto">
                                </td>
                                <td class="p-2">{{ $item->nama_event }}</td>

                                {{-- Mengambil data tiket pertama terkait event --}}
                                <td class="border p-4">
                                    {{ optional($item->tikets->first())->kategori_tiket ?? 'Tidak ada kategori' }}
                                </td>
                                <td class="border p-4">
                                    {{ optional($item->tikets->first())->harga_tiket ?? 'N/A' }}
                                </td>
                                <td class="border p-4">
                                    {{ optional($item->tikets->first())->jumlah_tiket ?? 'N/A' }}
                                </td>

                                {{-- Perbaikan Route Tambah Tiket --}}
                                <td class="p-2">
                                    @if ($item->tikets->isEmpty())
                                        <a href="{{ route('tambahtiket', ['event_id' => $item->id]) }}" class="text-blue-500 hover:underline">
                                            Tambah Tiket
                                        </a>
                                    @else
                                        <a href="" class="text-green-500 hover:underline">
                                            Edit Tiket
                                        </a>
                                    @endif
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
