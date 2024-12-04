




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
            width: 90%;
            padding: 20px;
            border-radius: 10px;
        }
        .form-group {
            display: grid;
            place-items: center;
            width: 100%;
        }
        .form-tm {
            display: grid;
            grid-template-columns: repeat(1, minmax(0, 1fr));
            gap: 10px;
            margin-top: 20px;
            width: 100%;
        }
        @media (min-width: 1024px) {
            .form-tm {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }
            .textarea {
                width: 305%;
            }
            .none {
                display: flex;
                padding-right: 5px;
            }
            .textarea{
                height: 6em;
            }
        }
        @media (max-width: 768px) {
            .none {
                display: none;
            }
        textarea{
         height: 6em;
        }
        }
        .textarea {
            padding: 10px;
            color: white;
            border-radius: 10px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: .3s ease-in-out ;
            outline: none;
            resize: none;
            background: rgba(45, 45, 45, 0.18);
            width: 100%;
        }
        .text-area{
            padding: 10px;
            color: white;
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: .3s ease-in-out ;
            outline: none;
            resize: none;
            background: rgba(45, 45, 45, 0.18);
            width: 100%;
        }
        .textarea::-webkit-scrollbar {
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
            transition: .3s ease-in-out;
            outline: none;
            padding: 10px;
        }
        input {
            width: 100%;
            cursor: pointer;
        }
        .box-input > label {
            padding: 12px;
            min-width: 200px;
        }
        .label-image {
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
        .mb-3 {
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
        .img-thumbnail{
            height: 250px;
            object-fit: cover;
        }
        .bg-img{
            background: rgba(255, 255, 255, 0.18);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            /* transition: .3s ease-in-out ; */
            outline: none;
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
            width: 100%;
        }
        .bg-p{
            background: rgba(45, 45, 45, 0.18);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            /* transition: .3s ease-in-out ; */
            outline: none;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
@endpush

@section('title', 'Tambah Event')

@section('content')

    <div class="container-tm">
        <div class="card">
            <h2 class="text-center mt-3 gap-2">Edit Event</h2>
            <form action="{{ route('postEditEvent', $event->id) }}" method="POST" class="form-group" enctype="multipart/form-data">
                @csrf
                <div class="form-tm">
                    <div class="mb-3 gap-2">
                        <label for="nama_event">Event Name</label>
                        <input type="text" name="nama_event" class="form-control" value="{{ $event->nama_event }}" required>
                    </div>

                    <div class="mb-3 gap-2">
                        <label for="nama_penyelenggara">Organizer Name</label>
                        <input type="text" name="nama_penyelenggara" class="form-control" value="{{ $event->nama_penyelenggara }}" required>
                    </div>

                    <div class="mb-3 gap-2">
                        <label for="tanggal_event">Event Date</label>
                        <input type="date" name="tanggal_event" class="form-control" value="{{ $event->tanggal_event }}" required>
                    </div>

                    <div class="mb-3 gap-2">
                        <label for="waktu_event">Event Time</label>
                        <input type="time" name="waktu_event" class="form-control" value="{{ $event->waktu_event }}" required>
                    </div>
                    <div class="mb-3 gap-2">
                        <label for="waktu_event">Event Time</label>
                        <input type="time" name="waktu_event" class="form-control" value="{{ $event->waktu_event }}" required>
                    </div>

                    <div class="mb-3 gap-2">
                        <label for="lokasi_event">Event Location</label>
                        <input type="text" name="lokasi_event" class="form-control" value="{{ $event->lokasi_event }}" required>
                    </div>

                    <div class="mb-3 gap-2">
                        <label for="maps" class="form-label">Maps URL</label>
                        <input type="url" class="form-control" id="maps" name="maps" value="{{ $event->maps }}" required>
                    </div>

                    <div class="mb-3 gap-2">
                       <label for="longitude" class="form-label">Longitude</label>
                       <input type="number" step="any" class="form-control" id="longitude" name="longitude" value="{{ $event->longitude }}" required>
                    </div>

                    <div class="mb-3 gap-2">
                        <label for="latitude" class="form-label">Latitude</label>
                        <input type="number" step="any" class="form-control" id="latitude" name="latitude" value="{{ $event->latitude }}" required>
                    </div>

                    <div class="mb-3 gap-2">
                        <label for="cover_event" class="form-label">Event Posters</label>
                        <input type="file" name="cover_event" class="form-control" id="uploadimage">
                        <label for="uploadimage" class="label-image justify-center flex">Upload File</label>
                        <small class="form-text text-muted">Leave it blank if you don't want to change the poster.</small>
                    </div>
                </div>
                @if ($event->cover_event)
                    <div class="mt-2 bg-img">
                        <p class="bg-p">Cover saat ini</p>
                        <img src="{{ asset( $event->cover_event) }}" alt="Current Cover" class="img-thumbnail" style="width:100%; border-radius:10px">
                        <div class="text-area">
                            <label for="deskripsi_event">Event Description</label>
                            <textarea name="deskripsi_event" class="form-control textarea" required>{{ $event->deskripsi_event }}</textarea>
                        </div>
                    </div>
                @endif
            <button type="submit" class="border p-2 rounded">Update Event</button>
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
