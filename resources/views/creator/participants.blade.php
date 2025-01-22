@extends('layouts.appCreator')

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
@endpush

@section('title', 'List of Participants - Tiket Mudah')

@section('content')
<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="p-4 border-b">
        <h5 class="text-lg font-semibold">Participant List Table</h5>
        <div class="mb-4">
            <form action="{{ route('filterEvents') }}" method="GET">
                <label for="eventFilter">Filter by Event:</label>
                <select id="eventFilter" name="event_id" onchange="this.form.submit()">
                    <option value="">All Events</option>
                    @foreach ($events as $event)
                        <option value="{{ $event->id }}" {{ isset($event_id) && $event_id == $event->id ? 'selected' : '' }}>
                            {{ $event->nama_event }}
                        </option>
                    @endforeach
                </select>
            </form>            
        </div>
    </div>
    
    <div class="p-4">
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200" id="example">
                <thead>
                    <tr class="bg-gray-100 text-gray-600">
                        <th class="py-2 px-4 border">No</th>
                        <th class="py-2 px-4 border">Customer Name</th>
                        <th class="py-2 px-4 border">Event Name</th>
                        <th class="py-2 px-4 border">Ticket Code</th>
                        <th class="py-2 px-4 border">Information</th>
                        <th class="py-2 px-4 border">Scan Time</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($participants as $participant)
                        <tr class="border-b">
                            <td class="p-2">{{ $loop->iteration }}</td>
                            <td class="p-2">{{ $participant->user->username }}</td>
                            <td class="p-2">{{ $participant->event->nama_event }}</td>
                            <td class="p-2">{{ $participant->kode_tiket }}</td>
                            <td class="p-2 text-center">
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
                            <td class="p-2">{{ $participant->scan_time }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        
        <div class="mt-4">
            {{ $participants->links() }}
        </div>
        
    </div>
</div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
@endpush
