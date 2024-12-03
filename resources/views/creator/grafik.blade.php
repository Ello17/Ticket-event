@extends('layouts.appCreator')

@push('css')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"> --}}
@endpush

@section('title', 'Home Creator - Tiket Mudah')

@section('content')
    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Grafik Penjualan Tiket Bulanan</h5>
                <canvas id="tiketChart"></canvas>
                @if(isset($message))
                    <div class="alert alert-warning mt-3">{{ $message }}</div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('tiketChart').getContext('2d');
        new Chart(ctx, {
            type: 'line', 
            data: {
                labels: @json($labels ?? []), 
                datasets: [{
                    label: 'Jumlah Tiket Terjual',
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
                            text: 'Tanggal'
                        },
                        beginAtZero: true
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Jumlah Tiket'
                        },
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endpush
