<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"> <!-- Custom CSS -->
    <!-- Import Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card p-4">
                    <h3 class="text-center mb-4">Edit Profile</h3>
                    <form action="{{ route('postEditProfileCust', $user->id) }}" method="POST" class="form-group" enctype="multipart/form-data">
                        @csrf
                        <label for="username" class="mt-3">Username</label>
                        <input type="text" value="{{ $user->username }}" id="username" name="username" class="form-control" placeholder="Masukkan Username" required>

                        <label for="email" class="mt-3">Email</label>
                        <input type="email" id="email" value="{{ $user->email }}" name="email" class="form-control" placeholder="Masukkan Email" required>
                        
                        <label for="profil" class="mt-3">Foto Profil (Opsional)</label>
                        <input type="file" id="profil" name="profil" accept="image/*" class="form-control">

                        <button type="submit" class="btn btn-login w-100 mt-3">Submit <i class="bi bi-box-arrow-in-right"></i></button>
                        <!-- Route 'profil' harus menyertakan user.id sebagai parameter -->
                        <a href="{{ route('profil', ['user' => $user->id]) }}" class="btn btn-outline-secondary w-100 mt-2">Back <i class="bi bi-box-arrow-in-right"></i></a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> <!-- Corrected JS Path -->
    <style>
        body {
            background-color: #6b7699;
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
            background: #ffffff; /* Optional: white background for card */
        }

        .btn-login {
            background-color: #6b7699;
            color: white;
        }

        .btn-login:hover {
            background-color: #dae1f7;
        }
    </style>
</body>

</html>
