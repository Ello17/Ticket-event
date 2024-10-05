@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('components/css/homeCustomer.css') }}">
@endpush

@section('title', 'Tiket Mudah hanya di Tiket Mudah')

@section('content')

<!-- Carousel 1 -->
<div id="carouselExampleRide" class="relative w-full" data-bs-ride="true">
    <div class="relative h-96 overflow-hidden">
        <div class="carousel-item active">
            <img src="{{ asset('components/asset/b1.jpeg') }}" class="block w-full h-full object-cover" alt="Slide 1">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('components/asset/b2.jpeg') }}" class="block w-full h-full object-cover" alt="Slide 2">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('components/asset/b3.jpeg') }}" class="block w-full h-full object-cover" alt="Slide 3">
        </div>
    </div>
    <button class="absolute top-1/2 left-0 -translate-y-1/2 bg-gray-900 text-white p-2 rounded-full" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </button>
    <button class="absolute top-1/2 right-0 -translate-y-1/2 bg-gray-900 text-white p-2 rounded-full" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </button>
</div>

<!-- Carousel 2 -->
<div class="my-8">
    <div class="flex space-x-4 justify-center">
        <img src="{{ asset('components/asset/b4.jpeg') }}" alt="Slide 1" class="w-80 h-48 object-cover">
        <img src="{{ asset('components/asset/b5.jpeg') }}" alt="Slide 2" class="w-80 h-48 object-cover">
        <img src="{{ asset('components/asset/b1.jpeg') }}" alt="Slide 3" class="w-80 h-48 object-cover">
    </div>
    <div class="flex justify-center space-x-4 mt-4">
        <button class="bg-blue-500 text-white py-2 px-4 rounded" onclick="prevSlide(2)">Previous</button>
        <button class="bg-blue-500 text-white py-2 px-4 rounded" onclick="nextSlide(2)">Next</button>
    </div>
</div>

<!-- Event Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 ">
    @foreach ($data as $item)
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <img src="{{ asset($item->cover_event) }}" alt="Event Image" class="w-full h-48 object-cover">
        <div class="p-4">
            <h5 class="text-xl font-semibold">{{ $item->nama_event }}</h5>
            <p class="text-gray-600">{{ $item->tanggal_event }}</p>
            <p class="text-gray-600">{{ $item->lokasi_event }}</p>
            <p class="text-gray-600">{{ $item->waktu_event }}</p>
            <a href="{{ route('detailEvent', $item->id) }}" class="inline-block bg-blue-500 text-white py-2 px-4 rounded mt-4">Detail</a>
        </div>
    </div>
    @endforeach
</div>

<div class="text-center mt-8">
    <a href="{{ route('listEvent') }}" class="text-blue-500 hover:underline">See All Events</a>
</div>

@endsection

@push('js')
<script src="{{ asset('components/js/slider.js') }}"></script>
@endpush
