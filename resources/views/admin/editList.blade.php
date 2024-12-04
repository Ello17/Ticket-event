@extends('layouts.appCreator')

@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"> --}}
    <style>
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
            width: 90%;
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
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
            margin-top: 20px;
            width: 100%;
        }
        @media (min-width: 1024px) {
            .form-tm {
            grid-template-columns: repeat(3, minmax(0, 1fr));
            }
            .textarea{
                width: 305%;
            }
            .none{
                display: flex;
                padding-right: 5px;
            }
        }
        @media (max-width: 768px){
            .none{
                display: none;
            }
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
            width: 100%;

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
        width: 100%;
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
        input[type="file"]{
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

@section('title', 'Edit Event')

@section('content')

    <div class="container-tm">
        <div class="card">
            <h2 class="text-center mt-3 gap-2">Edit Event</h2>
            <form action="{{ route('posteditlist', $events->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-tm">
                    <div class="mb-3 gap-2">
                        <label for="cover_event" class="form-label">Kategori Tiket</label>
                        <input type="file" accept="image/*" name="cover_event" class="form-control" id="uploadimage">
                        <label for="uploadimage" class="label-image justify-center flex">Upload File</label>
                    </div>

                    <div class="mb-3 gap-2">
                        <label for="cover_event">Cover</label>
                        <input type="file" accept="image/*" name="cover_event" class="form-control" id="uploadimage">
                        <label for="uploadimage" class="label-image justify-center flex">Upload File</label>
                    </div>

                    <div class="mb-3 gap-2">
                        <label for="nama_penyelenggara" class="form-label">Nama Penyelenggara</label>
                        <input type="text" id="nama_penyelenggara" required value="{{ old('nama_penyelenggara', $events->nama_penyelenggara) }}" name="nama_penyelenggara" class="form-control">
                    </div>

                    <div class="mb-3 gap-2">
                        <label for="nama_event">Nama Event</label>
                        <input type="text" id="nama_event" required value="{{ old('nama_event', $events->nama_event) }}" name="nama_event" class="form-control">
                    </div>

                    <div class="mb-3 gap-2">
                        <label for="tanggal_event">Tanggal Event</label>
                        <input type="date" id="tanggal_event" required value="{{ old('tanggal_event', $events->tanggal_event) }}" name="tanggal_event" class="form-control">
                    </div>

                    <div class="mb-3 gap-2">
                        <label for="waktu_event">Waktu Event</label>
                        <input type="time" id="waktu_event" required value="{{ old('waktu_event', $events->waktu_event) }}" name="waktu_event" class="form-control">
                    </div>

                    <div class="mb-3 gap-2">
                        <label for="lokasi_event">Lokasi Event</label>
                        <input type="text" id="lokasi_event" required value="{{ old('lokasi_event', $events->lokasi_event) }}" name="lokasi_event" class="form-control">
                    </div>

                    <div class="mb-3 gap-2">
                     <label for="deskripsi_event">Deskripsi Event</label>
                     <textarea id="deskripsi_event" required name="deskripsi_event" class="form-control textarea" rows="1">{{ old('deskripsi_event', $events->deskripsi_event) }}</textarea>
                    </div>

                </div>
                @if ($events->cover_event)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $events->cover_event) }}" alt="Current Cover" class="img-thumbnail" style="width:90%;">
                        <p>Cover saat ini</p>
                    </div>
                @endif
                <div style="display: flex; align-items:center; gap:10px;">
                    <button type="submit"  class="border" style="padding: 7px; border-radius:5px;">Submit</button>
                    <a href="{{ route('listEventAdm') }}" class="border" style="padding: 7px; border-radius:5px;">Back</a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
@endpush
