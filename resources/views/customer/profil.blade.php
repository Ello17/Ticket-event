@extends('layouts.app')

<<<<<<< HEAD
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
=======
@push('css')
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{asset('components/css/profile.css')}}">
@endpush
>>>>>>> dad18348525172e27bd36b9ba5b6062f02971094

@section('title', 'Profile')

<<<<<<< HEAD
        .profile-header {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .profile-header img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #c6cee7;
            margin-right: 1.5rem;
            max-width: 100%;
        }

        .profile-header h1 {
            margin: 0;
            font-size: 2rem;
            color: #f3f0f0;
        }

        .profile-header .btn {
            background-color: #b5bcd1;
            color: #232324;
            border: none;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            margin-right: 0.5rem;
        }

        .profile-header .btn:hover {
            background-color: #c6cee7;
        }

        .profile-info {
            margin-top: 1rem;
        }

        .profile-info .row {
            margin-bottom: 1rem;
            padding: 0.5rem 0;
            border-bottom: 1px solid #ddd;
        }

        .profile-info .col-md-4 {
            font-weight: bold;
            color: #f9f7f7;
        }

        .profile-info .col-md-8 {
            color: #f4f1f1;
        }

        table {
            width: 100%;
            margin-top: 1rem;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            color: #333; /* Ensure text color is dark for readability */
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        /* Class for white text */
        .text-white {
            color: white;
        }
    </style>
</head>

<body>
=======
@section('content')
>>>>>>> dad18348525172e27bd36b9ba5b6062f02971094

    <div class="container mt-5 py-5">
        <div class="profile-container">
            <div class="profile-header">
                <img src="{{ asset($user->profil) }}" alt="Foto Profil {{ $user->username }}">
                <div>
                    <h1>Hello, {{ $user->username }}</h1>
                    <a href="{{ route('editProfileCust', $user->id) }}" class="btn btn-sm">Edit Profil</a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-sm">Logout</button>
                    </form>
                    <a href="{{ route('homeCustomer') }}" class="btn btn-sm">Back</a>
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
                <div class="row">
                    <div class="col-md-4">
                        <i class="fas fa-lock"></i> <!-- Icon kunci dari Font Awesome -->
                        <a href="{{ route('ChangePass') }}" class="text-white">Ubah Password</a>
                    </div>
                </div>
            </div>
<<<<<<< HEAD



            <div class="card-body p-4">
                <div class="overflow-x-auto">
                    <table id="example">
                        <thead>
                            <tr class="bg-gray-100">
                                <th>No</th>
                                <th>Tiket Dibeli</th>
                                <th>Tanggal Transaksi</th>
                                <th>Jumlah Tiket</th>
                                <th>Total Transaksi</th>
                                <th>Nama Lengkap</th>
                                <th>No KTP</th>
                                <th>No Telepon</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-white">1</td>
                                <td class="text-white">1</td>
                                <td class="text-white">1</td>
                                <td class="text-white">1</td>
                                <td class="text-white">1</td>
                                <td class="text-white">1</td>
                                <td class="text-white">1</td>
                                <td class="text-white">1</td>
                                <td class="text-white">1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
=======
            <div class="btn-history">
                <a href="{{route('history')}}" class="btn">History</a>
>>>>>>> dad18348525172e27bd36b9ba5b6062f02971094
            </div>


@endsection
@push('js')
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
@endpush
