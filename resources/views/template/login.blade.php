@extends('layouts.app2')
@push('css')
<link rel="stylesheet" href="{{asset('components/css/register.css')}}">
@endpush
    @section('title', 'Sign Up')
    @section('content')

    <div class="container">
        <div class="box-image">
            <a href="{{route('home')}}">
            <img src="{{asset('components/asset/logo/512.png')}}" alt="">
            </a>
        </div>
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
                    @if (Session::has('notifikasi'))
                    <p class="error-message">{{ Session::get('notifikasi') }}</p>
                @endif

                <button type="submit" class="login_button">Log In</button>
                </div>
            </form>
            <p class="signup_login">
                       You do not have an account? <a href="{{ route('register') }}">Sign up</a>
            </p>
        </div>
    </div>


    @endsection
@push('js')
@endpush
