@extends('layouts.appAdmin')
@section('title', 'Home Admin - Tiket Mudah')
@section('content')
    <div class="card bg-white shadow-lg rounded-lg overflow-hidden">
        <div class="card-header p-4">
            <h5 class="text-lg font-semibold">Tabel List Event</h5>
        </div>
        <div class="card-body p-4">
            <div class="overflow-x-auto">
                <table id="eventTable" class="min-w-full bg-white table-auto border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">No</th>
                            <th class="border p-2">Cover</th>
                            <th class="border p-2">Event Name</th>
                            <th class="border p-2">Time</th>
                            <th class="border p-2">Event Location</th>
                            <th class="border p-2">Event Description</th>
                            <th class="border p-2">Price</th>
                            <th class="border p-2">Category</th>
                            <th class="border p-2">Ticket</th>
                            <th class="border p-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $e)
                            <tr>
                                <td class="border p-2">{{ $loop->iteration + ($events->currentPage() - 1) * $events->perPage() }}</td>
                                <td class="border p-2">
                                    <img src="{{ asset($e->cover_event) }}" alt="Cover Event" class="w-24" style="max-height: 40px; object-fit:cover">
                                </td>
                                <td class="border p-2">{{ $e->nama_event }}</td>
                                <td class="border p-2">
                                    <span>{{ $e->tanggal_event }}</span>
                                    <span>{{ $e->waktu_event }}</span>
                                </td>
                                <td class="border p-2">{{ $e->lokasi_event }}</td>
                                <td class="border p-2" title="{{ $e->deskripsi_event }}">
                                    {{ \Illuminate\Support\Str::limit($e->deskripsi_event, 50) }}
                                </td>
                                <td class="border p-2">{{ $e->tiket->first()->harga_tiket ?? '-' }}</td>
                                <td class="border p-2">{{ $e->tiket->first()->kategori_tiket ?? '-' }}</td>
                                <td class="border p-2">{{ $e->tiket->first()->jumlah_tiket ?? '-' }}</td>
                                <td class="border p-2">
                                    <div class="flex text-center space-x-2">
                                        <a href="{{ route('admin.editList', $e->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded text-sm">
                                            <i class="ri-edit-fill"></i>
                                        </a>
                                        <a href="{{ route('hapusList', $e->id) }}"
                                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-sm"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="ri-delete-bin-line"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- DataTables Scripts --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#eventTable').on('error.dt', function (e, settings, techNote, message) {
                console.log('DataTables error:', message);
            }).DataTable({
                "language": {
                    "search": "Search:",
                    "lengthMenu": "Show _MENU_ entries per page",
                    "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                    "infoEmpty": "No entries available",
                    "zeroRecords": "No matching records found",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    }
                },
                "pageLength": 10 // Number of entries per page
            });
        });
    </script>
@endsection
