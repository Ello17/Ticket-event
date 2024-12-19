@extends('layouts.appCreator')
@section('title', 'Home Creator')
@section('content')
<div class="grid grid-cols-1 gap-6 md:grid-cols-3 mt-6">
    <div class="bg-blue-500 p-6 rounded-md shadow-md flex justify-between items-center">
        <div>
            <h2 class="text-2xl text-white font-bold">Events</h2>
            <span class="text-white text-xl font-semibold">{{ $eventCount }}</span>
        </div>
        <div class="text-4xl text-white">
            <i class="ri-calendar-event-fill"></i>
        </div>
    </div>
</div>    


    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Monthly Ticket Sales Chart</h5>
                <canvas id="ticketChart"></canvas>
                @if(isset($message))
                    <div class="alert alert-warning mt-3">{{ $message }}</div>
                @endif
            </div>
        </div>
    </div>
{{-- @endsection --}}

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('ticketChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels ?? []),
                datasets: [{
                    label: 'Number of Tickets Sold',
                    data: @json($jumlahTiket ?? []),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date' // Changed to English
                        },
                        beginAtZero: true
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Tickets' // Changed to English
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endpush

@endsection



{{-- @extends('layouts.appCreator')

@push('css')
@endpush

@section('title', 'Home Creator - Tiket Mudah')

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
@endpush --}}
