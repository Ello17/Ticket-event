<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Home Admin</title>
    <style>
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: #fff;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto; /* Sidebar bisa di-scroll vertikal */
            z-index: 1000; /* Pastikan sidebar selalu di atas elemen lain */
        }

        .sidebar h4 {
            color: #007bff;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            transition: background-color 0.3s, color 0.3s;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background-color: #495057;
        }

        .sidebar .nav-link.active {
            color: #fff;
            background-color: #007bff;
        }

        .content {
            margin-left: 270px; /* Ensures content clears the sidebar */
            padding: 20px;
            overflow-x: hidden; /* Mencegah konten overflow secara horizontal */
        }

        .card {
            margin-top: 20px;
        }

        /* Ensuring table covers full width */
        .table-responsive {
            max-width: 100%; /* Menjaga tabel dalam lebar container */
            overflow-x: auto; /* Tabel bisa di-scroll horizontal */
            white-space: nowrap; /* Agar tabel tidak terpotong */
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h4 class="text-center">Sidebar</h4>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link active" href="{{ route('homeAdmin') }}">
                    <i class="bi bi-house-door-fill"></i> Home Admin
                </a>
            </li>
            <li class="nav-item mb-2">
                <a class="nav-link" href="{{ route('kelolaUser') }}">
                    <i class="bi bi-people-fill"></i> Kelola User
                </a>
            </li>
            {{-- <li class="nav-item mb-2">
                <a class="nav-link" href="{{ route('pending.users') }}">
                    <i class="bi bi-people-fill"></i>approve
                </a>
            </li> --}}
        </ul>
    </div>
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Tabel List Event</h5>
            </div>
            @if(Session::has('notifikasi'))
            <div class="alert alert-success">
                {{ Session::get('notifikasi') }}
            </div>
            @endif
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Cover</th>
                                    <th>Nama Penyelenggara</th>
                                    <th>Nama Event</th>
                                    <th>Tanggal Event</th>
                                    <th>Waktu Event</th>
                                    <th>Lokasi Event</th>
                                    <th>Deskripsi Event</th>
                                    <th>Harga</th>
                                    <th>Kategori</th>
                                    <th>Jumlah Tiket</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $e)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset($e->cover_event) }}" alt="Cover" class="card-img-top" style="width: 100px;"></td>
                                    <td>{{ $e->nama_penyelenggara }}</td>
                                    <td>{{ $e->nama_event }}</td>
                                    <td>{{ $e->tanggal_event }}</td>
                                    <td>{{ $e->waktu_event }}</td>
                                    <td>{{ $e->lokasi_event }}</td>
                                    <td>{{ $e->deskripsi_event }}</td>

                                    <!-- Cek apakah event memiliki tiket -->
                                    @if($e->tiket->isNotEmpty())
                                        @foreach($e->tiket as $tiket)
                                            <td>{{ $tiket->harga_tiket }}</td>
                                            <td>{{ $tiket->kategori_tiket }}</td>
                                            <td>{{ $tiket->jumlah_tiket }}</td>
                                        @endforeach
                                    @else
                                        <td colspan="3">Tidak ada tiket</td> <!-- Jika tidak ada tiket -->
                                    @endif

                                    <td class="actions">
                                        <a href="" class="btn btn-outline-primary">Edit</a>
                                        <a href="" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
