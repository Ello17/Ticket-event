@extends('layouts.appCreator')

@section('title', 'List of Participants - Tiket Mudah')

@section('content')
<div class="bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="p-4 border-b">
        <h5 class="text-lg font-semibold">Participant List Table</h5>
    </div>
    <div class="p-4">
        <!-- Event Dropdown -->
        <form method="GET" action="{{ route('filterEvents') }}">
            <label for="event-select" class="block text-gray-700 font-semibold">Select Event</label>
            <select name="event_id" id="event-select" class="mt-2 p-2 border border-gray-300 rounded" onchange="this.form.submit()">
                <option value="">All Events</option>
                @foreach ($events as $event)
                    <option value="{{ $event->id }}" {{ $event_id == $event->id ? 'selected' : '' }}>
                        {{ $event->nama_event }}
                    </option>
                @endforeach
            </select>
        </form>

        <!-- Table -->
        <div class="overflow-x-auto mt-4">
            <table class="min-w-full bg-white border border-gray-200" id="participantsTable">
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
                                    <span class="inline-block px-3 py-1 rounded-full bg-green-100 text-green-700">Presence</span>
                                @else
                                    <span class="inline-block px-3 py-1 rounded-full bg-red-100 text-red-700">Not present</span>
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

<!-- Chart Section -->
<div class="mt-6">
    <h5 class="text-lg font-semibold">Sales Chart</h5>
    <canvas id="salesChart" width="400" height="200"></canvas>
</div>
@endsection

@push('css')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script>
    $(document).ready(function() {
        // Log the eventSales data to check its format
        console.log('Event Sales Data:', @json($eventSales));

        // Initialize DataTable
        $('#participantsTable').DataTable({
            responsive: true,
            language: {
                search: "Search:",
                lengthMenu: "Show MENU entries",
                info: "Showing START to END of TOTAL entries",
                paginate: {
                    previous: "Previous",
                    next: "Next"
                }
            }
        });

        // Initialize Chart.js
        const eventSales = @json($eventSales);
        const ctx = document.getElementById('salesChart').getContext('2d');

        // Check if the canvas context is correctly obtained
        if (!ctx) {
            console.error('Failed to get canvas context!');
            return;
        }

        // Prepare the data for the chart
        const labels = eventSales.map(event => event.nama_event);
        const data = eventSales.map(event => event.transaksi.reduce((sum, trx) => sum + trx.total_tiket, 0));

        // Create the chart
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Tickets Sold',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

@endpush