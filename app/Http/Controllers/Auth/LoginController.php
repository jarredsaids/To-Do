<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function logout()
    {
        auth()->logout();

        return redirect(route('home'));
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        if ($authedUser = User::where('email', $user->email)->first()) {
            auth()->login($authedUser);

            return redirect(route('tasks.index'));
        }

        $authedUser = User::create([
            'name' => $user->name,
            'email' => $user->email,
        ]);

        auth()->login($authedUser);

        return redirect(route('tasks.index'));
    }
}
