@extends('layouts.app2')
@push('css')
<link rel="stylesheet" href="{{asset('components/css/register.css')}}">
@endpush
    @section('title', 'Sign Up')
    @section('content')

    <div class="container">
        <div class="box-image">
            <img src="{{asset('components/asset/logo/512.png')}}" alt="">
        </div>
        <div class="box-form">
            <h2>Register</h2>
            <form action="{{ route('postRegister') }}" enctype="multipart/form-data" method="POST" class="register_form">
                @csrf
                <div class="register-group">
                    <div>
                        <label for="username" class="register_label">Username</label>
                        <input type="text" name="username" placeholder="Enter Your Username" class="register_input" required value="{{ old('username') }}">
                    </div>
                    <div>
                        <label for="email" class="register_label">Email</label>
                        <input type="email" name="email" placeholder="Enter Your Email" class="register_input" required value="{{ old('email') }}">
                    </div>
                    <div>
                        <label for="password" class="register_label">Password</label>
                        <input type="password" name="password" placeholder="Enter Your Password" class="register_input" required>
                    </div>
                    <div>
                        <label for="password_confirmation" class="register_label">Confirm Password</label>
                        <input type="password" name="password_confirmation" placeholder="Confirm Your Password" class="register_input" required>
                    </div>
                    <input type="hidden" name="role" value="customer">
                </div>
                <div>
                    <button type="submit" class="register_button">Register</button>
                </div>
            </form>
            <p class="signup_login">
                Have an account? <a href="#">Sign up</a>
            </p>
        </div>
    </div>


    @endsection
@push('js')
@endpush
