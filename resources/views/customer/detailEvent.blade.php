@extends('layouts.app')
@push('css')

@endpush

@section('title', '')

@section('content')
<body class="bg-[#111827] text-white">
@if($event)
<div class="container mx-auto px-5 mt-10 ">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Image Section -->
        <div class="col-span-2">
            <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset($event->cover_event) }}" alt="poster-{{ $event->nama_event }}" class="w-full h-auto object-cover">
            </div>
        </div>

        <!-- Event Details Section -->
        <div>
            <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Event Details</h3>
                <div class="text-sm space-y-4">
                    <div>
                        <h5 class="text-sm font-medium text-gray-400">Tanggal</h5>
                        <p class="flex items-center text-gray-200">
                            <i class="fa-solid fa-calendar-days mr-2"></i>
                            {{ $event->tanggal_event }}
                        </p>
                    </div>
                    <div>
                        <h5 class="text-sm font-medium text-gray-400">Waktu</h5>
                        <p class="flex items-center text-gray-200">
                            <i class="fa-solid fa-clock mr-2"></i>
                            {{ $event->waktu_event }}
                        </p>
                    </div>
                    <div>
                        <h5 class="text-sm font-medium text-gray-400">Lokasi</h5>
                        <p class="flex items-center text-gray-200">
                            <i class="fa-solid fa-location-dot mr-2"></i>
                            {{ $event->lokasi_event }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Description Section -->
    <div class="mt-10">
        <h3 class="text-2xl font-semibold mb-4">Deskripsi Event</h3>
        <p class="leading-relaxed text-gray-300 text-sm">
            {{ $event->deskripsi_event }}
        </p>
    </div>
</div>
@else
<p class="text-center text-red-500">Event tidak ditemukan</p>
@endif
</body>
@endsection

@push('js')

@endpush
