<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');
    }

    public function verifyEmailWithOtp(Request $request)
    {
        $request->validate([
            'verification_code' => 'required'
        ]);

        $code = $request->verification_code;

        # Check if verification code is valid
        $verifcationCode = $request->user()->verificationCodes()->unUsed()->where('code', $code)->latest()->first();

        # Mark email as verified and update code to used
        if ($verifcationCode) {

            $request->user()->markEmailAsVerified();
            $verifcationCode->markAsUsed();
            event(new Verified($request->user()));

            return redirect()->intended(RouteServiceProvider::HOME.'?verified=1');

        }

        return redirect()->back()->withErrors(['verification_code' => 'Invalid verification code']);


    }
}
