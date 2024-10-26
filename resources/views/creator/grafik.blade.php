{{-- @extends('layouts.appCreator')

@push('css')
@endpush

@section('title', 'Home Creator - Tiket Mudah')

@section('content')
 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <div class="container mt-4">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Grafik Penjualan</h5>
                <canvas id="tiketChart"></canvas>
            </div>
        </div>
    </div>
    @endsection

    {{-- @push('scripts') --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Chart.js data
            const ctx = document.getElementById('tiketChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels ?? []),
                    datasets: [{
                        label: 'Tikets',
                        data: @json($jumlahTiket ?? []),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    @endpush --}}

    <!-- Bootstrap JS -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}



    @extends('layouts.appCreator')
    @push('css')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    @endpush
    @section('title', 'Home Creator - Tiket Mudah')
    @section('content')
        <div class="container mt-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Grafik Penjualan</h5>
                    <canvas id="tiketChart"></canvas>
                </div>
            </div>
        </div>
    @endsection

{{-- @push('scripts') --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('tiketChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($labels ?? []),
                    datasets: [{
                        label: 'Tikets',
                        data: @json($jumlahTiket ?? []),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
     <!-- Bootstrap JS -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

{{-- @endpush --}}

