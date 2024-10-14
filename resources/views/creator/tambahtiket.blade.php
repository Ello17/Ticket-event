<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Tiket</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
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
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <h2 class="text-center mt-3">Tambah Tiket</h2>
                <form action="{{ route('tambahtiket.store') }}" method="POST" class="form-group" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="event_id" value="{{ $event_id }}">

                    <label for="kategori_tiket">Kategori Tiket</label>
                    <input type="text" required name="kategori_tiket" class="form-control" placeholder="Masukkan Kategori Tiket">

                    <label for="harga_tiket">Harga Tiket</label>
                    <input type="text" required name="harga_tiket" class="form-control" placeholder="Masukkan Harga Tiket">

                    <label for="jumlah_tiket">Jumlah Tiket</label>
                    <input type="text" required name="jumlah_tiket" class="form-control" placeholder="Masukkan Jumlah Tiket">

                    <button type="submit" class="btn btn-success mt-3" >Tambah</button>
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


    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>

</html>
