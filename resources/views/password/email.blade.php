@extends('layouts.app2')
@section('content')
@push('css')
<link rel="stylesheet" href="{{asset('components/css/register.css')}}">
@endpush
<div class="container-form">
    <div class="box-form">
        <h2>{{ __('Reset Password') }}</h2>
        <form method="POST" action="{{ route('password.email') }}" class="login_form" style="height: fit-content;">
            @csrf
            <div class="register-group form-group">
                <div>
                    <label for="email" class="login_label">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="login_input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Email">
                    @error('email')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>
            <div>
                <button type="submit" class="login_button">
                    {{ __('Send Password Reset Link') }}
                </button>
            </div>
        </form>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    </div>
</div>
@endif

<style>
    .alert {
        color: white;
    }
</style>
@endsection
