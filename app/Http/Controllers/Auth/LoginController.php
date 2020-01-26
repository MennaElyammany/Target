<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Facebook\Facebook;


class LoginController extends Controller
{
    public function redirectToProviderFacebook()
    {       //   session_start();
        return Socialite::driver('facebook')->redirect();
    }
    public function handleProviderFacebookCallback()
    {
        // session_start();
         $user = Socialite::driver('facebook')->user();
        // dd($user);
        $fb=new Facebook(config('facebook.config'));
        $fb->setDefaultAccessToken($user->token);
        $fields = "id,cover,name,first_name,last_name,hometown,age_range,birthday,location,likes,posts,friends,link,gender,email,name_format,locale,picture,timezone,updated_time,verified";
        $fb_user = $fb->get('/me?fields='.$fields)->getGraphNode();
        $existingUser = User::where('email', $user->getEmail())->first();


        if ($existingUser) {
            auth()->login($existingUser, true);
            return redirect()->route('home');

        } else {
            $newUser                    = new User;
            $newUser->provider_name     = 'facebook';
            $newUser->provider_id       = $user->getId();
            $newUser->name              = $user->getName();
            $newUser->email             = $user->getEmail();
            $newUser->email_verified_at = now();
            $newUser->avatar            = $user->getAvatar();
            $newUser->role              = 'influencer';
            $newUser->facebook_token    =$user->token;
            $newUser->save();
    
            auth()->login($newUser, true);
            return redirect()->route('influencers.create');


        
    }
    }

    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderGoogleCallback()
    {
        $user = Socialite::driver('google')->user();
        // dd($user);
        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
            return redirect()->route('home');
        } else {
            $newUser                    = new User;
            $newUser->provider_name     = 'google';
            $newUser->provider_id       = $user->getId();
            $newUser->name              = $user->getName();
            $newUser->email             = $user->getEmail();
            $newUser->email_verified_at = now();
            $newUser->avatar            = $user->getAvatar();
            $newUser->role              = 'influencer';
            $newUser->save();
    
            auth()->login($newUser, true);
            return redirect()->route('influencers.create');

    }
}
    

    use AuthenticatesUsers;

    public function redirectTo(){
        
        // User role
        $role = Auth::user()->role; 
        
        // Check user role
        switch ($role) {
            case 'influencer':
                    return '/home';
                break;
            case 'client':
                    return '/home';
                break; 
            default:
                    return '/home'; 
                break;
        }
    }
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
