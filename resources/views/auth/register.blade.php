@extends('layouts.auth.auth1')

@section('title')
    Login to Your Account
@endsection

@push('head')
    <meta property="description" content="Securely access your account on Ripple Alight by entering your credentials. Stay connected with our services and exclusive content.">

    <meta property="og:title" content="Login to Your Account"/>
    <meta property="og:description" content="Securely access your account on Ripple Alight by entering your credentials. Stay connected with our services and exclusive content."/>
@endpush

@push('head')
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endpush

@section('content')
    <form method="POST" id="registration-form" action="{{ route('register') }}">
        @csrf

        <x-bootstrap.form.input name='name' label='Full name' :wire="false" :col="false"></x-bootstrap.form.input>

        <x-bootstrap.form.input name='email' label='Email' :wire="false" :col="false"></x-bootstrap.form.input>

        <x-bootstrap.form.input type='password' name='password' label='Password' :wire="false" :col="false">
        </x-bootstrap.form.input>

        <x-bootstrap.form.input type='password' name='password_confirmation' label='Confirm password' :wire="false"
            :col="false">
        </x-bootstrap.form.input>

        <x-bootstrap.form.checkbox value="1" name='tos' :wire="false" :col="false">
            <x-slot name="label">
                By registering you are agreeing with our <a href="{{ route('guest.tos.client') }}">terms of services</a>
            </x-slot>
        </x-bootstrap.form.checkbox>

        <x-bootstrap.recaptcha></x-bootstrap.recaptcha>

        <x-bootstrap.form.button id="register-button" :col="false" text='Register'></x-bootstrap.form.button>
    </form>

    <div class="mt-5 text-muted text-center">
        Already have an account ? <a href="{{ route('login') }}">SignIn</a>
    </div>


    <div class="text-center mt-5">
        <p class="mb-3 fs-5 fw-bold">Or sign up with</p>

        <a href="{{ route('social.login', ['driver' => 'google', 'user' => RoleEnum::CUSTOMER->value]) }}" class="d-inline-flex align-items-center justify-content-center btn btn-outline-primary border-2 p-0 mx-1 rounded-circle" style="width: 40px; height: 40px">
            <i class="mdi mdi-google"></i>
        </a>

        <a href="{{ route('social.login', ['driver' => 'twitch', 'user' => RoleEnum::CUSTOMER->value]) }}" class="d-inline-flex align-items-center justify-content-center btn btn-outline-primary border-2 p-0 mx-1 rounded-circle" style="width: 40px; height: 40px">
            <i class="mdi mdi-twitch"></i>
        </a>

        <a href="{{ route('social.login', ['driver' => 'discord', 'user' => RoleEnum::CUSTOMER->value]) }}" class="d-inline-flex align-items-center justify-content-center btn btn-outline-primary border-2 p-0 mx-1 rounded-circle" style="width: 40px; height: 40px">
            <i class="mdi mdi-discord"></i>
        </a>
    </div>
@endsection

@push('foot')

<script>
    $(document).ready(function() {
        $("#registration-form").submit(function() {
            // Disable the register button
            $("#register-button").prop("disabled", true);

            // Optionally, you can show a loading indicator
            $("#register-button").html("Registering...");
        });
    });
</script>

@endpush
