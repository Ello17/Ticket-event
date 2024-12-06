@extends('layouts.appCreator')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
@endpush
@section('title', 'Home Creator - Tiket Mudah')

@section('content')
    <div class="content p-8">
        <div class="card bg-white shadow-lg rounded-lg">
            <div class="card-header p-4">
                <h5 class="text-lg font-semibold">Event List Table</h5>
            </div>
            <div class="card-body p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200" id="example">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600">
                                <th class="py-2 px-4 border">Poster</th>
                                <th class="py-2 px-4 border">Event Name</th>
                                <th class="py-2 px-4 border">Organizer Name</th>
                                <th class="py-2 px-4 border">Event Location</th>
                                <th class="py-2 px-4 border">Event Date</th>
                                <th class="py-2 px-4 border">Event Time</th>
                                <th class="py-2 px-4 border">Event Description</th>
                                <th class="py-2 px-4 border">Actions</th>
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
                                        <div class="flex text-center justify-center space-x-2">
                                            <a href="{{ route('editEvent', $item->id) }}"
                                                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded text-sm">Edit</a>
                                            <a href="{{ route('hapusEvent', $item->id) }}"
                                                class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded text-sm"
                                                onclick="return confirm('Are you sure?')">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $events->links() }}
                    </div>
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
