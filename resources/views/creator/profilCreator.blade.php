@extends('layouts.appCreator')
@push('css')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{asset('components/css/profile.css')}}">
@endpush

@section('title', 'Profile Creator - Tiket Mudah')
@section('content')



<div class="container mt-5 py-5">
    <div class="profile-container">
        <div class="profile-header">
            <img src="{{ asset($user->profil ?? 'components/asset/logo/user.png') }}" alt="Foto Profil {{ $user->username }}">
            <div>
                <h1>Hello, {{ $user->username }}</h1>
                <a href="{{ route('editProfileCreator', $user->id) }}" class="btn btn-sm">Edit Profil</a>
                {{-- <a href="{{ route('homeCreator') }}" class="btn btn-sm">Back</a> --}}
            </div>
        </div>

        <div class="profile-info">
            <div class="row">
                <div class="username"><i class="ri-user-fill"></i> Username: </div>
                <div class="username-info">{{ $user->username }}</div>
            </div>
            <div class="row">
                <div class="email"><i class="ri-mail-fill"></i> Email: </div>
                <div class="email-info">{{ $user->email }}</div>
            </div>
            <div class="row">
                <a href="{{ route('ubahpass') }}"
                <div class="col-md-4">
                    <i class="fas fa-lock"></i> <!-- Icon kunci dari Font Awesome -->
                    <span class="text-white"> Ubah Password</span>
                </div>
                </a>
            </div>
        </div>




@endsection
@push('js')
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
@endpush
