<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Google_Client;
use Google_Service_YouTube;
use Google_Service_People;
use GuzzleHttp\Client;

class GoogleLoginController extends Controller
{
    public function redirectToProviderGoogle(request $request)
    {           //my code
         session(['role' => $request->role]);
         return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderGoogleCallback()
    {  $role=session('role');
       $user = Socialite::driver('google')->stateless()->user();    
     $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
            return redirect()->route('influencers.index');
        } else {
            if(!empty($role)){
            $newUser                    = new User;
            $newUser->provider_name     = 'google';
            $newUser->provider_id       = $user->getId();
            $newUser->name              = $user->getName();
            $newUser->email             = $user->getEmail();
            $newUser->email_verified_at = now();
            $newUser->youtube_avatar            = $user->getAvatar();
            $newUser->avatar            = $user->getAvatar();
            $newUser->role= $role;
            $newUser->save();
            auth()->login($newUser, true);
            $newUser->assignRole($newUser->role);  //assign role
            return redirect(redirectTo());
        }
        else
  return view('auth.login',['msg'=> 'You are not registered.']);
       }

    }

    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
