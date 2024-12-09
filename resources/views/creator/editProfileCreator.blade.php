<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profil Creator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.5.0/remixicon.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card p-4">
                    <h3 class="text-center mb-4" style="color:white;">Edit Profile</h3>
                    <form action="{{ route('postEditProfileCreator', $user->id) }}" method="POST" class="form-group" enctype="multipart/form-data">
                        @csrf
                        <label for="username" class="mt-3 text-white pb-2">Username</label>
                        <input type="text" value="{{ $user->username }}" id="username" name="username" class="form-control" placeholder="Enter Username" required>

                        <label for="email" class="mt-3 text-white pb-2">Email</label>
                        <input type="email" id="email" value="{{ $user->email }}" name="email" class="form-control" placeholder="Enter Email" required>

                        <label for="profil" class="mt-3 text-white pb-2">Profile picture (Opsional)</label>
                        <input type="file" id="profil" name="profil" accept="image/*" class="form-control">

                        <button type="submit" class="btn btn-login w-100 mt-3">Submit <i class="bi bi-box-arrow-in-right"></i></button>
                        <a href="{{url()->previous()}}" class="btn btn-outline-secondary w-100 mt-2">Back <i class="ri-arrow-go-back-line"></i></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <style>
        body {
            background-color: #fff;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background:#1f2937 ;
        }

        .btn-login {
            /* background-color: #003cff; */
            background-color:#3b82f6 ;
            color: white;
        }
        .btn-login:hover {
            background-color: #60a5fa;
        }
    </style>
</body>

</html>
