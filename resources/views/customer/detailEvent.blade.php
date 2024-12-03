@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('components/css/detailevent.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
@endpush

@section('title', 'Detail Event')

@section('content')
    <body class="bg-[#111827] text-white" style="width: 100%;">
        @if ($event)
            <div class="container mx-auto px-5 mt-10">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="col-span-2">
                        <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ asset($event->cover_event) }}"
                                alt="poster-{{ $event->nama_event }}"
                                class="img-max w-full lg:h-[498px] h-auto object-cover">
                        </div>
                    </div>

                    <div class="lg:w-full w-full">
                        <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                            <h3 class="text-lg font-semibold mb-4">Detail Event</h3>
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

                        @if ($tiket)
                            <div class="mt-8">
                                <h3 class="text-2xl font-semibold mb-4">Tiket</h3>
                                @foreach ($tiket as $item)
                                    <form action="{{ route('transaksi.tiket', ['tiket' => $item->id, 'id' => $event->id]) }}" method="GET">
                                        <div class="bg-gray-800 rounded-lg shadow-lg p-6 mb-6">
                                            <div class="mb-4">
                                                <h5 class="text-white font-semibold">{{ $item->kategori_tiket }}</h5>
                                                <p class="text-white">Harga: Rp {{ number_format($item->harga_tiket, 0, ',', '.') }}</p>
                                                <p class="text-gray-400">Ketersediaan: ({{ $item->jumlah_tiket }} tiket tersedia)</p>
                                            </div>
                                            <div class="tiket-input">
                                                <div>
                                                    @if (strtolower($item->kategori_tiket) === 'online')
                                                        <input type="number" class="form-control text-black"
                                                            name="tiket_dibeli" value="1" readonly style="width: 200px;">
                                                    @else
                                                        <input type="number" class="form-control text-black"
                                                            name="tiket_dibeli" min="1" max="{{ $item->jumlah_tiket }}"
                                                            placeholder="Masukkan jumlah tiket" style="width: 200px;" inputmode="numeric">
                                                    @endif
                                                </div>
                                                <div>
                                                    <button type="submit" class="btn btn-warning w-full lg:w-auto">Beli Tiket</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center text-red-500">Tiket tidak tersedia</p>
                        @endif
                    </div>
                </div>

                <div class="my-10">
                    <h3 class="text-2xl font-semibold mb-4">Deskripsi Event</h3>
                    <p class="leading-relaxed text-gray-300 text-sm">{{ $event->deskripsi_event }}</p>
                </div>

                <div class="my-10">
                    <h3 class="text-2xl font-semibold mb-2">Lokasi Event</h3>
                    <p class="mb-4">
                        <strong>Alamat: </strong>
                        <a href="{{ $event->maps }}" class="text-white hover:text-blue-500">{{ $event->lokasi_event }}</a>
                    </p>
                    <div id="map-{{ $event->id }}" style="width: 100%; height: 200px;"></div>
                    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var latitude = @json($event->latitude);
                            var longitude = @json($event->longitude);

                            var map = L.map('map-{{ $event->id }}').setView([latitude, longitude], 14);

                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 19,
                            }).addTo(map);

                            L.marker([latitude, longitude]).addTo(map)
                                .bindPopup("{{ $event->nama_event }}")
                                .openPopup();
                        });
                    </script>
                </div>
            </div>
        @else
            <p class="text-center text-red-500">Event tidak ditemukan</p>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger mt-3" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </body>
@endsection

@push('js')
@endpush
