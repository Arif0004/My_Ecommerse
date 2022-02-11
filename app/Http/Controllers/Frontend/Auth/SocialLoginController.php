<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function login($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        //return $provider;
        $userData = Socialite::driver($provider)->user();

        $user = Customer::whereEmail($userData->getEmail())->first();

        if (!$user) {
            $user =  Customer::create([
                'name' => $userData->getName(),
                'email' => $userData->getEmail(),
                'password' => bcrypt('password')
            ]);

            // Mail::to($user->email)->send(new SocialNewUserMail($user));
        }
        Auth::guard('customer')->login($user);
        return redirect()->route('dashboard');
    }
}
