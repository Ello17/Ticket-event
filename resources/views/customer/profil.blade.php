@extends('layouts.app')

@push('css')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('components/css/profile.css') }}">
@endpush

@section('title', 'Profile')

@section('content')
<div class="container mt-5 py-5">
    <div class="profile-container bg-light p-4 rounded">
        <div class="profile-header d-flex align-items-center">
            <img src="{{ asset($user->profil ?? 'components/asset/logo/user.png') }}"
                 alt="Foto Profil {{ $user->username }}" class="rounded-circle me-3" width="100" height="100">
            <div>
                <h1>Hello, {{ $user->username }}</h1>
                <div class="d-flex gap-2 mt-2">
                    <a href="{{ route('editProfileCust', $user->id) }}" class="btn btn-primary btn-sm">Edit Profil</a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                    </form>
                    <a href="{{ route('homeCustomer') }}" class="btn btn-secondary btn-sm">Back</a>
                </div>
            </div>
        </div>

        <div class="profile-info mt-4">
            <div class="row mb-2">
                <div class="col-md-2 fw-bold"><i class="ri-user-fill me-1"></i> Username:</div>
                <div class="col-md-10">{{ $user->username }}</div>
            </div>
            <div class="row mb-2">
                <div class="col-md-2 fw-bold"><i class="ri-mail-fill me-1"></i> Email:</div>
                <div class="col-md-10">{{ $user->email }}</div>
            </div>
            <div class="row mt-3">
                <a href="{{ route('ChangePass') }}" class="col-md-4 text-decoration-none">
                    <i class="fas fa-lock me-2"></i> <span>Ubah Password</span>
                </a>
            </div>
        </div>

        <div class="btn-history mt-4">
            <a href="{{ route('history') }}" class="btn btn-outline-primary">
                <i class="ri-history-line me-1"></i> History
            </a>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
@endpush
