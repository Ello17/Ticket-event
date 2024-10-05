<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<script src="https://cdn.tailwindcss.com"></script>
    <title>Login Creator</title>
</head>
<body>

    <div class="container">
        <div class="box-image">
            <a href="{{route('homeCreator')}}">
            <img src="{{asset('components/asset/logo/512.png')}}" alt="">
            </a>
        </div>
        @if(Session::has('notifikasi'))
        <div class="alert alert-danger">
            {{ Session::get('notifikasi') }}
        </div>
    @endif    
        <div class="box-form">
            <h2>Login</h2>
            <form action="{{ route('postLogin') }}" class="login_form" method="POST">
                @csrf
                <div class="register-group">
                    <div>
                        <label for="email" class="login_label">Email</label>
                        <input type="email" name="email" placeholder="Write your email" id="email" class="login_input">
                    </div>
                    <div>
                        <label for="password"  class="login_label">Password</label>
                        <input type="password" name="password" placeholder="Enter your password" id="password" class="login_input">
                    </div>
                </div>
                <div>

                    <button type="submit" class="login_button">Log In</button>
                </div>
                @if (Session::has('notifikasi'))
                <p class="error-message">{{ Session::get('notifikasi') }}</p>
            @endif
            </form>
            <p class="signup_login">
                       You do not have an account? <a href="{{ route('registerCreator') }}">Sign up</a>
            </p>
        </div>
    </div>


    @endsection
@push('js')
@endpush

</body>
</html>