@extends('layouts.app2')
@push('css')
<link rel="stylesheet" href="{{asset('components/css/register.css')}}">
@endpush
    @section('title', 'Sign Up')
    @section('content')

    <div class="container">
        <div class="box-image">
            <img src="#" alt="">
        </div>
        <div class="box-form">
            <form action="{{Route('postRegister')}}" enctype="multipart/form-data">
                <h2>Register</h2>
                <div class="register-group">
                    <div>
                        <label for="username" class="register_label">Username</label>
                        <input type="text" placeholder="Enter Your Username" class="register_input">
                    </div>
                    <div>
                        <label for="email" class="register_label">Email</label>
                        <input type="email" placeholder="Enter Your Email" class="register_input">
                    </div>
                    <div>
                        <label for="password" class="register_label">Password</label>
                        <input type="password" placeholder="Enter Your Password" class="register_input">
                    </div>
                    <input type="text" style="display: none;" name="role" value="customer">
                </div>
                <div>
                    <p class="signup_login">
                        Have an account? <a href="#">Sign up</a>
                    </p>

                    <button type="submit" class="register_button">Register</button>
                 </div>
            </form>
        </div>
    </div>

    @endsection
@push('js')
@endpush
