@extends('layouts.appCreator')

@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    <style>
        body {
            background-color: #ffffff;
        }

        .container-tm {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .card {
            background: #1f2937;
            width: fit-content;
            padding: 20px;
            border-radius: 10px;
        }
        .form-group{
            display: grid;
            place-items: center;
            width: 100%;
        }
        .form-tm {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 10px;
            margin-top: 20px;
            width: 100%;
        }
        .textarea{
            padding: 10px;
            color: white;
            background: rgba(255, 255, 255, 0.18);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: .3s ease-in-out ;
            outline: none;
            resize: none;
        }
        .textarea::-webkit-scrollbar{
            display: none;
        }
        .form-tm input,
                .label-image {
            background: rgba(255, 255, 255, 0.18);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: .3s ease-in-out ;
            outline: none;
            padding: 10px;
        }
        input{
        width: 200px;
        cursor: pointer;
        }
    .box-input > label{
        padding: 12px;
        min-width: 200px;
    }
        .label-image{
            cursor: pointer;
        }
        .form-tm input:focus,
        .textarea:focus {
            background: rgba(255, 255, 255, 0.75);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: black;
        }
        .image input[type="file"]{
            display: none;
        }
        .mb-3{
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        /* .card {
                        margin: 0 auto;
                        max-width: fit-content;
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
                    .form-tm{
                        display: flex
                    } */
    </style>
@endpush

@section('title', 'Tambah Event')

@section('content')

    <div class="container-tm">
        <div class="card">
            <h2 class="text-center mt-3">Tambah Event</h2>
            <form action="{{ route('postTambahEvent') }}" method="POST" class="form-group " enctype="multipart/form-data">
                @csrf
                <div class="form-tm">
                    <div class="mb-3">
                        <label for="nama_event" class="form-label">Nama Event</label>
                        <br>
                        <input type="text" name="nama_event" class="form-control" placeholder="Masukkan nama event"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="nama_penyelenggara" class="form-label">Nama Penyelenggara</label>
                        <br>
                        <input type="text" name="nama_penyelenggara" class="form-control"
                            placeholder="Masukkan nama penyelenggara" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_event" class="form-label">Tanggal Event</label>
                        <br>
                        <input type="date" name="tanggal_event" class="form-control" required min="{{ date('Y-m-d') }}">
                    </div>

                    <div class="mb-3">
                        <label for="waktu_event" class="form-label">Waktu Event</label>
                        <br>
                        <input type="time" name="waktu_event" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="lokasi_event" class="form-label">Lokasi</label>
                        <br>
                        <input type="text" name="lokasi_event" class="form-control" placeholder="Masukkan lokasi event"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="maps" class="form-label">Maps URL</label>
                        <br>
                        <input type="url" name="maps" class="form-control" placeholder="Masukkan URL Maps" required>
                    </div>

                    <div class="mb-3">
                        <label for="longitude" class="form-label">Longitude</label>
                        <br>
                        <input type="text" inputmode="numeric" name="longitude" class="form-control" step="any"
                            placeholder="Masukkan longitude" required>
                    </div>

                    <div class="mb-3">
                        <label for="latitude" class="form-label">Latitude</label>
                        <br>
                        <input type="text" inputmode="numeric" name="latitude" class="form-control" step="any"
                            placeholder="Masukkan latitude" required>
                    </div>

                    <div class="mb-3 image">
                        <label for="cover_event" class="form-label">Poster Event</label>
                        <br>
                        <div class="box-input">
                            <input type="file" accept="image/*" name="cover_event" class="form-control" id="uploadimage" required>
                            <label for="uploadimage" class="label-image">Upload File</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi_event" class="form-label">Deskripsi</label>
                        <br>
                        <textarea name="deskripsi_event" class="form-control textarea" rows="3" placeholder="Masukkan deskripsi event" required></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3 border" style="padding: 10px; border-radius:5px;">Tambah</button>
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

@endsection

@push('js')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
@endpush
