{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Change Password Creator</title>
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 5%;
        }

        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .btn-login {
            background-color: #6c757d;
            color: white;
            border: none;
        }

        .btn-login:hover {
            background-color: #5a6268;
        }

        h3 {
            color: #333;
        }
    </style>
</head>
<body>
    @if ($errors->any())
                    <div class="alert alert-danger mt-3" role="alert">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card p-4">
                    <h3 class="text-center mb-4">Change Password</h3>
                    <form action="{{ route('postubahpass') }}" method="POST" class="form-group">
                        @csrf
                        <label for="password" class="mt-3">Old Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Input Your Old Password" required>

                        <label for="new_password" class="mt-3">New Password</label>
                        <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Input Your New Password" required>

                        <label for="confirmation_password" class="mt-3">Confirm New Password</label>
                        <input type="password" id="confirmation_password" name="confirmation_password" class="form-control" placeholder="Confirm New Password" required>

                        <button type="submit" class="btn btn-login w-100 mt-4">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html> --}}

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
                    <form action="{{ route('postubahpass') }}" method="POST" class="form-group">
                        @csrf
                        <label for="password" class="mt-3 text-white">Old Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Input Your Old Password" required>

                        <label for="new_password" class="mt-3 text-white">New Password</label>
                        <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Input Your New Password" required>

                        <label for="confirmation_password" class="mt-3 text-white">Confirm New Password</label>
                        <input type="password" id="confirmation_password" name="confirmation_password" class="form-control" placeholder="Confirm New Password" required>

                        <button type="submit" class="btn btn-login w-100 mt-4">Submit</button>
                        @if ($errors->any())
                        <div class="alert alert-danger mt-3" role="alert">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
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
