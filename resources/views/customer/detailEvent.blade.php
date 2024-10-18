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

{{-- <h3 class="mb-4 text-white">Tiket</h3>
@foreach($tiket as $tiket)
<form action="{{ route('transaksi', $tiket->id) }}" method="GET">
    <div class="border rounded p-3 mb-3 shadow-sm">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <div>
                <h6 class="mb-1 text-white">Ketersediaan Tiket : {{ $tiket->availability_text }}</h6>
                <h5 class="mb-1 text-white">{{ $tiket->kategori_tiket }}</h5>
                <p class="mb-0 text-white"><strong>Harga :  </strong>  <span>{{ $tiket->harga }}</span></p>
            </div>
                <div class="row">
                    <div class="col-12" style="margin-left: 30rem; margin-top:35px">
                        <input type="number" class="form-control" name="jumlah_tiket" min="1" max="{{ $tiket->jumlah_tiket - $tiket->transaksi()->sum('jumlah_tiket') }}" placeholder="Masukkan jumlah tiket" style="width: 200px;">
                    </div>
                </div>
                <div class="row mt-1">
                    <div class="col-12">
                        <h5 class="mb-2 text-white">{{ $tiket->status }}</h5>
                        <button type="submit" class="btn btn-warning w-100">Beli Tiket</button>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endforeach
--}}


@push('js')

@endpush
