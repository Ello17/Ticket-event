@extends('layouts.app')
@push('css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('components/css/list-event.css') }}?v=1.0">
<link rel="stylesheet" href="{{ asset('components/css/homeCustomer.css') }}?v=1.0">
@endpush

@section('title', 'Tiket Mudah hanya di Tiket Mudah')

@section('content')
<section class="card-section">
    @if ($events->isEmpty())
    <p class="text-white mt-5">No events found.</p>
    @else
    <div class="grid-card">
        @foreach($events as $event)
        <a href="{{ route('detailEvent', $event->id) }}">
            <div class="card">
                <div class="img-card">
                    <img src="{{ asset($event->cover_event) }}" alt="Poster {{ $event->nama_event }}">
                </div>
                <div class="text-card-detail">
                    <h2 class="text-card text-white">{{ $event->nama_event }}</h2>
                    <p class="text-white text-card">{{ $event->tanggal_event }}</p>
                    <p class="text-white text-card">{{ \Illuminate\Support\Str::limit($event->lokasi_event, 40) }}</p>
                    <p class="text-white text-card">{{ $event->waktu_event }}</p>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <!-- Tambahkan pagination di bawah daftar event -->
    <div class="pagination mt-4">
        {{ $events->links('pagination::bootstrap-4') }}
    </div>
    @endif
</section>

<!-- Pagination pindah ke bawah -->
@if (!$events->isEmpty())
<div class="pagination-wrapper mt-4">
    {{ $events->links('pagination::bootstrap-4') }}
</div>
@endif

@endsection

@push('js')
@endpush
