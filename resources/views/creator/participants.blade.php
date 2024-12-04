@extends('layouts.appCreator')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
@endpush

@section('title', 'Profile Creator - Tiket Mudah')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-4">List of Participants</h1>

    <div class="card bg-white shadow-lg rounded-lg">
        <div class="card-header p-4">
            <h5 class="text-lg font-semibold">Participants Table</h5>
        </div>
        <div class="card-body p-4">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200" id="example">
                    <thead class="bg-gray-100 text-gray-600">
                        <tr>
                            <th class="py-2 px-4 border">No</th>
                            <th class="py-2 px-4 border">Customer Name</th>
                            <th class="py-2 px-4 border">Event Name</th>
                            <th class="py-2 px-4 border">Ticket Code</th>
                            <th class="py-2 px-4 border">Information</th>
                            <th class="py-2 px-4 border">Scan Time</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        @foreach($participants as $participant)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2 px-4 border text-sm text-gray-600">{{ $loop->iteration }}</td>
                            <td class="py-2 px-4 border text-sm text-gray-600">{{ $participant->user->username }}</td>
                            <td class="py-2 px-4 border text-sm text-gray-600">{{ $participant->event->nama_event }}</td>
                            <td class="py-2 px-4 border text-sm text-gray-600">{{ $participant->kode_tiket }}</td>
                            <td class="py-2 px-4 border text-sm text-center">
                                @if ($participant->is_present)
                                    <span class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-700">
                                        Presence
                                    </span>
                                @else
                                    <span class="inline-block px-3 py-1 rounded-full bg-red-100 text-red-700">
                                        Not present
                                    </span>
                                @endif
                            </td>
                            <td class="py-2 px-4 border text-sm text-gray-600">{{ $participant->scan_time }}</td>
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
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
@endpush
