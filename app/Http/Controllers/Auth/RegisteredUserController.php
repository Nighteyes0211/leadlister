<?php

namespace App\Http\Controllers\Auth;

use App\Enum\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\RealEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        Validator::make(
            $request->all(),
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255',  Rule::unique('users')->whereNot('is_deleted', 1), 'indisposable', new RealEmail ],
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
                'tos' => ['accepted'],
                'g-recaptcha-response' => 'required|recaptcha'
            ],
            [
                'g-recaptcha-response.recaptcha' => 'Captcha verification failed',
                'g-recaptcha-response.required' => 'Please complete the captcha'
            ]
        )->validate();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'active' => true,
            'tos' => $request->tos,
            'tos_agreed_at' => now(),
        ]);


        $referrer_code = session()->get('ref');
        $referrer = $referrer_code ? User::where('referral_code', $referrer_code)->first() : null;

        if ($referrer) {
            $referrer->referrals()->create([
                'user_id' => $user->id,
            ]);
        }

        $user->assignRole(RoleEnum::CUSTOMER->value);


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
