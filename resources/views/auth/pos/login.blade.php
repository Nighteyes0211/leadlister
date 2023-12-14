@extends('layouts.auth.auth1')
@section('title')
    Login to POS
@endsection
@section('content')
    <div class="p-4 pt-6 text-center">
        <x-bootstrap.brand class="mb-5 pb-5"></x-bootstrap.brand>
        <h1 class="mb-2">Login to POS</h1>
        <p class="text-muted">Sign In to your account</p>
    </div>
    <form class="card-body" method="POST" action="{{ route('pos.login') }}">
        @csrf
        <x-bootstrap.form.input name='email' label='Email' :wire="false" :col="false"></x-bootstrap.form.input>
        <x-bootstrap.form.input type='password' name='password' label='Password' :wire="false" :col="false">
        </x-bootstrap.form.input>
        <x-bootstrap.form.checkbox name='remember' label='Remember me' :wire="false" :col="false">
        </x-bootstrap.form.checkbox>
        {{-- <div class="my-3 text-muted text-center">
            <a href="{{ route('password.request') }}">Forgot password.</a>
        </div> --}}
        {{-- <x-bootstrap.form.button :col="false">Login</x-bootstrap.form.button> --}}
        <button type="submit" class="btn btn-primary btn-lg w-100">Login</button>
    </form>
@endsection
