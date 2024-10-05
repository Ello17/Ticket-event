<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Creator</title>
</head>
<body>
    <form method="POST" action="{{ route('postRegisterCreator') }}">
        @csrf
        <div class="form-group">
            <label for="name">Nama</label>
            <input id="name" type="text" class="form-control" name="name" required>
        </div>
    
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control" name="email" required>
        </div>
    
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>
    
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Daftar sebagai Creator</button>
        </div>

        <p class="signup_login">
            Have an account? <a href="{{route('loginCreator')}}">Sign in</a>
        </p>
    </form>
    
</body>
</html>