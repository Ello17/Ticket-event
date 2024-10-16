<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Event</title>
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
                <h2 class="text-center mt-3">Edit Event</h2>
                <form action="{{ route('postEditEvent', $event->id) }}" method="POST" class="form-group" enctype="multipart/form-data">
                    @csrf

                    <label for="nama_event">Nama Event</label>
                    <input type="text" name="nama_event" class="form-control" value="{{ $event->nama_event }}" required>

                    <label for="nama_penyelenggara">Nama Penyelenggara</label>
                    <input type="text" name="nama_penyelenggara" class="form-control" value="{{ $event->nama_penyelenggara }}" required>

                    <label for="tanggal_event">Tanggal Event</label>
                    <input type="date" name="tanggal_event" class="form-control" value="{{ $event->tanggal_event }}" required>

                    <label for="waktu_event">Waktu Event</label>
                    <input type="time" name="waktu_event" class="form-control" value="{{ $event->waktu_event }}" required>

                    <label for="lokasi_event">Lokasi Event</label>
                    <input type="text" name="lokasi_event" class="form-control" value="{{ $event->lokasi_event }}" required>

                    <label for="deskripsi_event">Deskripsi Event</label>
                    <textarea name="deskripsi_event" class="form-control" rows="3" required>{{ $event->deskripsi_event }}</textarea>

                    <label for="cover_event">Poster Event</label>
                    <input type="file" name="cover_event" class="form-control">
                    <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengganti poster.</small>

                    <button type="submit" class="btn btn-primary mt-3">Update Event</button>
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
