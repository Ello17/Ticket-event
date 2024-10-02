<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Edit List</title>
</head>
<body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center">Edit List</h5>
                            <form action="{{ route('posteditlist', $events->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="cover">Cover</label>
                                    <input type="file" accept="image/*" name="cover" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nama_penyelenggara">Nama Penyelenggara</label>
                                    <input type="text" id="nama_penyelenggara" required value="{{ $events->nama_penyelenggara }}" name="nama_penyelenggara" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="nama_event">Nama Event</label>
                                    <input type="text" id="nama_event" required value="{{ $events->nama_event }}" name="nama_event" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_event">Tanggal Event</label>
                                    <input type="text" id="tanggal_event" required value="{{ $events->tanggal_event }}" name="tanggal_event" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="waktu_event">Waktu Event</label>
                                    <input type="text" id="waktu_event" required value="{{ $events->waktu_event }}" name="waktu_event" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="lokasi_event">Lokasi Event</label>
                                    <input type="text" id="lokasi_event" required value="{{ $events->lokasi_event }}" name="lokasi_event" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi_event">Deskripsi Event</label>
                                    <input type="text" id="deskripsi_event" required value="{{ $events->deskripsi_event }}" name="deskripsi_event" class="form-control">
                                </div>event
                                <button type="submit" class="btn btn-success btn-block">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>                      
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
</html>