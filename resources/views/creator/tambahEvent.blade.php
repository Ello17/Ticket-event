@extends('layouts.appCreator')

@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    <style>
        body {
            background-color: #ffffff;
        }

        .card {
            margin: 0 auto;
            max-width: 500px;
            padding: 20px;
            background-color: #b9e2f4;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            text-align: center;
            margin-top: 0;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-success {
            width: 100%;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
@endpush

@section('title', 'Tambah Event')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <h2 class="text-center mt-3">Tambah Event</h2>
                <form action="{{ route('postTambahEvent') }}" method="POST" class="form-group" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="nama_event" class="form-label">Nama Event</label>
                        <input type="text" name="nama_event" class="form-control" placeholder="Masukkan nama event" required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_penyelenggara" class="form-label">Nama Penyelenggara</label>
                        <input type="text" name="nama_penyelenggara" class="form-control" placeholder="Masukkan nama penyelenggara" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_event" class="form-label">Tanggal Event</label>
                        <input type="date" name="tanggal_event" class="form-control" required min="{{ date('Y-m-d') }}">
                    </div>

                    <div class="mb-3">
                        <label for="waktu_event" class="form-label">Waktu Event</label>
                        <input type="time" name="waktu_event" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="lokasi_event" class="form-label">Lokasi</label>
                        <input type="text" name="lokasi_event" class="form-control" placeholder="Masukkan lokasi event" required>
                    </div>

                    <div class="mb-3">
                        <label for="maps" class="form-label">Maps URL</label>
                        <input type="url" name="maps" class="form-control" placeholder="Masukkan URL Maps" required>
                    </div>

                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <input type="number" name="longitude" class="form-control" step="any" placeholder="Masukkan longitude" required>
                    </div>

                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="number" name="latitude" class="form-control" step="any" placeholder="Masukkan latitude" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi_event" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi_event" class="form-control" rows="3" placeholder="Masukkan deskripsi event" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="cover_event" class="form-label">Poster Event</label>
                        <input type="file" accept="image/*" name="cover_event" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success mt-3">Tambah</button>
                </form>

                @if ($errors->any())
                    <div class="alert alert-danger mt-3" role="alert">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
@endpush
