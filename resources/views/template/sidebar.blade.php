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
<style>
        Styling sidebar
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
