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
        .form-group{
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

@section('title', 'Edit Tiket')

@section('content')

    <div class="container-tm">
        <div class="card">
            <h2 class="text-center mt-3 gap-2">Edit Ticket</h2>
            <form action="{{ route('postEditTiket', $tiket->id) }}" method="POST" class="form-group" enctype="multipart/form-data">
                @csrf
                <div class="form-tm">
                    <div class="mb-3 gap-2">
                        <label for="kategori_tiket" class="form-label">Ticket Category</label>
                        <input type="text" name="kategori_tiket" class="form-control" value="{{ $tiket->kategori_tiket }}" required>
                    </div>

                    <div class="mb-3 gap-2">
                        <label for="harga_tiket" class="form-label flex">Price</label>
                        <input type="text" name="harga_tiket" class="form-control" value="{{ $tiket->harga_tiket }}" required>
                    </div>

                    <div class="mb-3 gap-2">
                        <label for="jumlah_tiket" class="form-label">Number of Tickets</label>
                        <input type="text" name="jumlah_tiket" class="form-control" value="{{ $tiket->jumlah_tiket }}" required>
                    </div>

                    <div class="mb-3 gap-2">
                        <label for="link_tiket" class="form-label">Event Link (Opsional)</label>
                        <input type="text" name="link_tiket" class="form-control"
                        value="{{ $tiket->link_tiket }}"
                        placeholder="Masukkan Link Zoom jika diperlukan">
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3 border" style="padding: 10px; border-radius:5px;">Add</button>
            </form>

            @if($errors->any())
            <div class="alert alert-danger mt-3">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @if (session('pesan-berhasil'))
            <div class="alert alert-success mt-3">
                {{ session('pesan-berhasil') }}
            </div>
        @endif
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
@endpush
