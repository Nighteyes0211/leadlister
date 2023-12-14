@extends('layouts.auth.auth1')
@section('title')
    Forgot Password
@endsection
@section('content')
    <h4 class="card-title mb-5">Forgot password?</h4>

    @if (session('status'))
        <div class='font-medium  text-success'>
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                name="email" tabindex="1" value="{{ old('email') }}" autofocus required>
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                Send Reset Link
            </button>
        </div>
    </form>

    <div class="mt-5 text-muted text-center">
        Recalled your login info? <a href="{{ route('login') }}">Sign In</a>
    </div>
@endsection
