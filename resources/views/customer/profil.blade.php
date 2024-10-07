<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .profile-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
        }

        .profile-header img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #85603F;
            margin-right: 1.5rem;
        }

        .profile-header h1 {
            margin: 0;
            font-size: 2rem;
            color: #333;
        }

        .profile-header .btn {
            background-color: #85603F;
            color: #fff;
            border: none;
            font-size: 0.875rem;
            margin-top: 0.5rem;
        }

        .profile-header .btn:hover {
            background-color: #705b42;
        }

        .profile-info {
            margin-top: 1rem;
        }

        .profile-info .row {
            margin-bottom: 1rem;
            padding: 0.5rem 0;
            border-bottom: 1px solid #ddd;
        }

        .profile-info .col-md-4 {
            font-weight: bold;
            color: #555;
        }

        .profile-info .col-md-8 {
            color: #333;
        }
    </style>
</head>

<body>
    

    <div class="container mt-5 py-5">
        <div class="profile-container">
            <div class="profile-header">
                <img src="{{ asset($user->gambar) }}" alt="Foto Profil">
                <div>
                    <h1>Hello {{ $user->username }}</h1>
                    <a href="{{ route('editProfilAdmin', $user->id) }}" class="btn btn-sm">Edit Profil</a>
                </div>
            </div>

            <div class="profile-info">
                <div class="row">
                    <div class="col-md-4">Username: </div>
                    <div class="col-md-8">{{ $user->username }}</div>
                </div>
                <div class="row">
                    <div class="col-md-4">Email: </div>
                    <div class="col-md-8">{{ $user->email }}</div>
                </div>
                <div class="row">
                    <div class="col-md-4">Password: </div>
                    <div class="col-md-8">{{ $user->password }}</div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
