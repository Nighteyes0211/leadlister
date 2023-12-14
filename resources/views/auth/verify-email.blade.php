@extends('layouts.auth.auth1')

@section('title') Verfiy email @endsection

@section('content')
    <div class="mb-4 text-muted">
        Thanks for signing up! Before getting started, could you verify your email address by adding verification code we just emailed to you? If you didn't receive the email, we will gladly send you another.
    </div>

    @if (session('status') == 'verification-code-sent')
        <div class="mb-4 font-medium text-success">
            A new verification code has been sent to the email address you provided during registration. If not recieved, please check your spam folder as well.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">

        <form method="POST" action="{{ route('email.otp.verify') }}">
            @csrf
            
            <x-bootstrap.form.input maxlength="6" :col="false" max="6" :wire="false" label="Verfication code" name="verification_code"></x-bootstrap.form.input>
            <x-bootstrap.form.button :col="false" >Verify email</x-bootstrap.form.butto>
        </form>

        <div class="d-flex gap-4 align-items-center">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button type="submit" class="btn btn-primary bg-transparent text-primary p-2">Resend Code</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="btn btn-transperent p-0 text-primary rounded-md ">
                    Log out
                </button>
            </form>
        </div>
    </div>
@endsection
