<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Creator</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.datatable.js') }}"></script>
    <script src="{{ asset('js/datatable.bootstrap5.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #ffffff;
        }
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table th {
            font-weight: bold;
            background-color: #0057b8;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #ffffff;
        }

        .table-striped tbody tr:hover {
            background-color: #e2e2e2;
        }
    </style>
</head>

<body>
   
    <div class="d-flex">
      

        <div class="container mt-5 py-5">
            <div>
                <h2>Dashboard <span class="rounded-background">Creator</span></h2>
                <h5 class=" fw-normal"><i class="fa-solid fa-user mt-2"></i> Selamat datang Creator</h5>
                <hr style="border: 1.7px solid black;">
            </div>
            <div class="card border-0 mt-4 p-3 shadow">
                <h4>Tabel Event</h4>
                <hr>
                @if (session('notifikasi'))
                    <div class="alert alert-success">
                        {{ session('notifikasi') }}
                    </div>
                @endif
                <table class="table table-striped" id="example" class="display">
                    <thead style="background-color: #003b95" class="text-white">
                        <tr>
                            <th>Poster</th>
                            <th>Nama Event</th>
                            <th>Nama Penyelenggara</th>
                            <th>Lokasi Event</th>
                            <th>Tanggal Event</th>
                            <th>Waktu Event</th>
                            <th>Deskripsi Event</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $item)
                        <tr>
                            <td><img src="{{ asset($item->cover_event) }}" alt="" class="card-img-top" style="width: 75px"></td>
                            <td>{{ $item->nama_event }}</td>
                            <td>{{ $item->nama_penyelenggara }}</td>
                            <td>{{ $item->lokasi_event }}</td>
                            <td>{{ $item->tanggal_event }}</td>
                            <td>{{ $item->waktu_event }}</td>
                            <td>{{ $item->deskripsi_event }}</td>
                            <td><a href="{{route('detailEvent', $item->id)}}">Detail</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        new DataTable('#example');
    </script>
</body>

</html>
