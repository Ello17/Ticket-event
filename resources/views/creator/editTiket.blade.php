<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Tiket</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            margin: 0 auto;
            max-width: 600px;
            padding: 20px;
            background-color: #e3f2fd;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            text-align: center;
            margin-top: 0;
        }

        .form-control {
            margin-bottom: 15px;
        }

        .btn-primary {
            width: 100%;
        }

        .alert {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <h2 class="text-center mt-3">Edit Tiket</h2>
                <form action="{{ route('postEditTiket',$tiket->id) }}" method="POST" class="form-group" enctype="multipart/form-data">
                    @csrf

                    <label for="kategori_tiket">Kategori Tiket</label>
                    <input type="text" name="kategori_tiket" class="form-control" value="{{ $tiket->kategori_tiket }}" required>

                    <label for="harga_tiket">Harga</label>
                    <input type="text" name="harga_tiket" class="form-control" value="{{ $tiket->harga_tiket }}" required>

                    <label for="jumlah_tiket">Jumlah Tiket</label>
                    <input type="text" name="jumlah_tiket" class="form-control" value="{{ $tiket->jumlah_tiket }}" required>
                    <button type="submit" class="btn btn-primary mt-3">Update Tiket</button>
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
    </div>

    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
