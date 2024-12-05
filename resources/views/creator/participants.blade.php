@extends('layouts.appCreator')

@section('title', 'List of Participants - Tiket Mudah')

@section('content')
<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="p-4 border-b">
        <h5 class="text-lg font-semibold">Participant List Table</h5>
    </div>
    <div class="p-4">
        <form method="GET" action="{{ route('participants') }}" class="mb-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by username or email" class="border rounded px-2 py-1">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-3 rounded"><i class="ri-search-2-line"></i></button>
        </form>

        <!-- Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200">
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
    </div>
</div>
@endsection
