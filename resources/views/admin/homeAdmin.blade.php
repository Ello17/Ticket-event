<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Home Admin</title>
    <style>
        .content {
            margin-left: 260px; /* Menyesuaikan jarak dengan lebar sidebar */
            padding: 20px;
            overflow-x: hidden; /* Mencegah konten overflow secara horizontal */
        }

        .card {
            margin-top: 20px;
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto; /* Menambahkan scroll jika tabel terlalu lebar */
        }

        .actions {
            white-space: nowrap; /* Mencegah tombol terpotong */
        }

        .actions a {
            display: inline-block; /* Membuat tombol tetap berbaris */
            margin-right: 5px; /* Memberikan jarak antar tombol */
        }

        /* Styling sidebar */
        .sidebar {
            height: 100%;
            width: 260px; /* Lebih lebar untuk ruang konten */
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            color: #fff;
            padding-top: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }

        .sidebar h4 {
            color: #00aaff;
            text-align: center;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            font-size: 16px;
            padding: 12px 20px;
            border-radius: 5px;
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

        .sidebar .collapse {
            background-color: #6c757d;
            padding-left: 20px;
        }

        .sidebar .collapse .nav-link {
            padding: 8px 25px;
            font-size: 14px;
        }

        .sidebar .nav-item {
            margin-bottom: 15px; /* Menambah jarak antar item menu */
        }

        .sidebar .nav-item i {
            margin-right: 10px; /* Jarak antara ikon dan teks */
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h4>Admin Menu</h4>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('homeAdmin') }}">
                    <i class="ri-home-4-fill"></i> Home Admin
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#userSubmenu" role="button" aria-expanded="false" aria-controls="userSubmenu">
                    <i class="ri-user-3-fill"></i> Kelola User
                    <i class="ri-arrow-down-s-line float-end"></i>
                </a>
                <div class="collapse" id="userSubmenu">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('kelolaUser') }}">Customer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Creator</a>
                        </li>
                    </ul>
                </div>
            </li>
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
                                    <td><img src="{{ asset($e->cover_event) }}" alt="Cover Event" style="width: 100px;"></td>
                                    <td>{{ $e->nama_penyelenggara }}</td>
                                    <td>{{ $e->nama_event }}</td>
                                    <td>{{ $e->tanggal_event }}</td>
                                    <td>{{ $e->waktu_event }}</td>
                                    <td>{{ $e->lokasi_event }}</td>
                                    <td>{{ $e->deskripsi_event }}</td>

                                    @if($e->tiket->isNotEmpty())
                                        <td>{{ $e->tiket->first()->harga_tiket }}</td>
                                        <td>{{ $e->tiket->first()->kategori_tiket }}</td>
                                        <td>{{ $e->tiket->first()->jumlah_tiket }}</td>
                                    @else
                                        <td colspan="3">Tidak ada tiket</td>
                                    @endif

                                    <td class="actions">
                                        <a href="{{ route('admin.editList', $e->id) }}" class="btn btn-outline-primary">Edit</a>
                                        <a href="{{ route('hapusList', $e->id) }}" class="btn btn-outline-danger" onclick="return confirm('Are you sure?')">Hapus</a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
