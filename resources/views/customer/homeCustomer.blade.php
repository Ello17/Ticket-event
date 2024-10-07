@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('components/css/homeCustomer.css') }}">
<link rel="stylesheet" href="{{asset('components/css/slider.css')}}">
@endpush

@section('title', 'Tiket Mudah hanya di Tiket Mudah')

@section('content')
<div class="slider">
    <div class="list">
        <div class="item">
            <img src="{{ asset('components/asset/b1.jpeg') }}" alt="">
        </div>
        <div class="item">
            <img src="{{ asset('components/asset/b2.jpeg') }}" alt="">
        </div>
        <div class="item">
            <img src="{{ asset('components/asset/b3.jpeg') }}" alt="">
        </div>
    </div>
    <div class="buttons">
        <button id="prev"><</button>
        <button id="next">></button>
    </div>
    <ul class="dots">
        <li class="active"></li>
        <li></li>
        <li></li>
    </ul>
</div>
<div class="slidertwo">
    <div class="listtwo">
        <div class="itemtwo">
            <img src="{{ asset('components/asset/promo.png') }}" alt="">
        </div>
        <div class="itemtwo">
            <img src="{{ asset('components/asset/promo1.png') }}" alt="">
        </div>
        <div class="itemtwo">
            <img src="{{ asset('components/asset/promo2.png') }}" alt="">
        </div>
    </div>
    <div class="buttonstwo">
        <button id="prevtwo"><</button>
        <button id="nexttwo">></button>
    </div>
    <ul class="dotstwo">
        <li class="activetwo"></li>
        <li></li>
        <li></li>
    </ul>
</div>

<!-- Event Cards -->
<<<<<<< HEAD
{{-- <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mt-5 px-5">
=======
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
>>>>>>> 302512421c3f944e57e6124b5e229b4730c93146
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
