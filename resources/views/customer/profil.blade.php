@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{asset('components/css/profile.css')}}">
@endpush

@section('title', 'Profile')

@section('content')

    <div class="container mt-5 py-5">
        <div class="profile-container">
            <div class="profile-header">
                <img src="{{ asset($user->profil) }}" alt="Foto Profil {{ $user->username }}">
                <div>
                    <h1>Hello, {{ $user->username }}</h1>
                    <a href="{{ route('editProfileCust', $user->id) }}" class="btn btn-sm">Edit Profil</a>

                    <!-- Tambahkan tombol logout -->
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm">Logout</button>
                    </form>
                </div>
            </div>

            <div class="profile-info">
                <div class="row">
                    <div class="username">Username: </div>
                    <div class="username-info">{{ $user->username }}</div>
                </div>
                <div class="row">
                    <div class="email">Email: </div>
                    <div class="email-info">{{ $user->email }}</div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
@endpush
