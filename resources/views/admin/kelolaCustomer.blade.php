<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Kelola User</title>
    <style>
        body {
            display: flex;
        }
        .content {
            margin-left: 260px; /* Mengatur margin sesuai sidebar */
            padding: 20px;
            width: 100%;
        }

        .sidebar {
        height: 100%;
        width: 260px;
        position: fixed;
        top: 0;
        left: 0;
        background-color: #343a40;
        color: #fff;
        padding-top: 20px;
        box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        overflow-y: auto;
        z-index: 99999;
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
        margin-bottom: 15px;
    }

    .sidebar .nav-item i {
        margin-right: 10px;
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
               <div class="dropdown">
                <button class="nav-link dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Kelola User
                </button>
                 <ul class="dropdown-menu">
                 <li><a class="dropdown-item" href="{{ route('kelolaCustomer') }}">Customer</a></li>
                 <li><a class="dropdown-item" href="{{route('kelolaKreator') }}">Creator</a></li>
                 <li><a class="dropdown-item" href="">Approve Creator</a></li>
      </ul>
    </div>
            </li>
        </ul>
    </div>
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Kelola User</h5>
            </div>
            @if(Session::has('notifikasi'))
            <div class="alert alert-success">
                {{ Session::get('notifikasi') }}
            </div>
            @endif
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td class="actions">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
