<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <title>Change Password</title>
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
                    <form action="{{ route('postChangePassMin') }}" method="POST" class="form-group">
                        @csrf
                        <!-- Old Password Input -->
                        <label for="password" class="mt-3">Old Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Input Your Old Password" required>

                        <!-- New Password Input -->
                        <label for="new_password" class="mt-3">New Password</label>
                        <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Input Your New Password" required>

                        <!-- Confirmation Password Input -->
                        <label for="confirmation_password" class="mt-3">Confirm New Password</label>
                        <input type="password" id="confirmation_password" name="confirmation_password" class="form-control" placeholder="Confirm New Password" required>

                        <button type="submit" class="btn btn-login w-100 mt-4">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> <!-- Corrected JS Path -->
</body>
</html>
