@extends('layouts.app2')
@push('css')
<link rel="stylesheet" href="{{asset('components/css/register.css')}}">
@endpush
@section('content')
<div class="container-form">
    <div class="box-form">
        <h2>{{ __('Reset Password') }}</h2>
        <form method="POST" action="{{ route('password.update') }}" class="login_form" style="height: fit-content;">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="register-group form-group">
                <div>
                    <label for="email" class="login_label">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="login_input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email">
                </div>
                <div>
                    <label for="password" class="login_label">{{ __('Password') }}</label>
                    <input id="password" type="password" class="login_input form-control @error('password') is-invalid @enderror" name="password" required placeholder="Password">
                </div>
                <div>
                    <label for="password-confirm" class="login_label">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="login_input form-control" name="password_confirmation" required placeholder="Confirm Your Password">
                </div>
            </div>
            <div>
                <button type="submit" class="login_button">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
        @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
        @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    </div>
</div>

<style>
    body{
        overflow: hidden;
    }
    .invalid-feedback{
        color: white
    }
</style>
@endsection
