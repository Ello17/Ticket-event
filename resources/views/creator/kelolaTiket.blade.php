@extends('layouts.appCreator')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
@endpush

@section('title', 'Kelola Tiket - Tiket Mudah')

@section('content')
    <div class="content p-8">
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
                                <th class="py-2 px-4 border">Event Name</th>
                                <th class="py-2 px-4 border">Kategori Tiket</th>
                                <th class="py-2 px-4 border">Price</th>
                                <th class="py-2 px-4 border">Offline Event Link</th>
                                <th class="py-2 px-4 border">Number of Tickets</th>
                                <th class="py-2 px-4 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700">
                            @foreach ($events as $item)
                                <tr class="border-b" id="row-{{ $item->tiket->first()->id ?? '' }}">
                                    <td class="p-2">
                                        <img src="{{ asset($item->cover_event) }}" alt="Poster Event" class="w-20 h-auto">
                                    </td>
                                    <td class="p-2">{{ $item->nama_event }}</td>
                                    <td class="border p-4">
                                        {{ $item->tiket->first()->kategori_tiket ?? 'No categories' }}
                                    </td>
                                    <td class="border p-4">
                                        {{ $item->tiket->first()->harga_tiket ?? 'N/A' }}
                                    </td>
                                    <td class="border p-4">
                                        {{ $item->tiket->first()->link_tiket ?? 'N/A' }}
                                    </td>
                                    <td class="border p-4">
                                        {{ $item->tiket->first()->jumlah_tiket ?? 'N/A' }}
                                    </td>
                                    <td class="p-2">
                                        <div class="flex text-center justify-center space-x-2">
                                            @if ($item->tiket->isEmpty())
                                                <a href="{{ route('tambahtiket', ['event_id' => $item->id]) }}"
                                                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-3 rounded text-sm">Add Ticket</a>
                                            @else
                                                <a href="{{ route('editTiket', $item->tiket->first()->id) }}"
                                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded text-sm">Edit</a>
                                                <form action="{{ route('hapusTiket', $item->tiket->first()->id) }}"
                                                    method="POST" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus tiket ini?');">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
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
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function () {
            // Check if DataTable is already initialized
            if (!$.fn.DataTable.isDataTable('#example')) {
                $('#example').DataTable({
                    language: {
                        search: "Search:",
                        lengthMenu: "Show _MENU_ entries per page",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        infoEmpty: "No entries available",
                        zeroRecords: "No matching records found",
                        paginate: {
                            first: "First",
                            last: "Last",
                            next: "Next",
                            previous: "Previous"
                        }
                    },
                    pageLength: 10, // Default number of entries per page
                    responsive: true, // Makes the table responsive
                });
            }
        });
    </script>

@endpush
