<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Kelola User</title>
</head>
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
</style>
<body>
    <div class="sidebar">
        <h4 class="text-center">Sidebar</h4>
        <hr>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link" href="{{ route('homeAdmin') }}">
                    <i class="bi bi-house-door-fill"></i> Home Admin
                </a>
            </li>
        </ul>
        <ul class="nav flex-column">
            <li class="nav-item mb-2">
                <a class="nav-link active" href="{{ route('kelolaUser') }}">
                    <i class="bi bi-house-door-fill"></i> Kelola User
                </a>
            </li>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>