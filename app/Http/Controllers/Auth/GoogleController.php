<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            $user = User::where('google_id', $googleUser->id)->first();

            if ($user) {
                // If user exists, log them in
                Auth::login($user);
            } else {
                // If user doesn't exist, check if email exists
                $user = User::where('email', $googleUser->email)->first();

                if ($user) {
                    // Update existing user with google_id
                    $user->update([
                        'google_id' => $googleUser->id,
                        'avatar' => $googleUser->avatar,
                    ]);
                    Auth::login($user);
                } else {
                    // Create new user
                    $user = User::create([
                        'name' => $googleUser->name,
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'avatar' => $googleUser->avatar,
                        'password' => null, // Password handled by Google
                        'role' => 'customer', // Default role for Google login
                        'email_verified_at' => now(),
                    ]);
                    Auth::login($user);
                }
            }

            // Redirect based on role
            if ($user->isAdmin()) {
                return redirect()->intended('/admin');
            }

            return redirect()->intended(route('shop.index', absolute: false));

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Gagal login dengan Google, silakan coba lagi.');
        }
    }
}
