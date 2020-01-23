<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectToProviderFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleProviderFacebookCallback()
    {
         $user = Socialite::driver('facebook')->user();
        // dd($user);
    //     $fb=new Facebook(config('facebook.config'));
    //     // $response = $fb->get('/me', $user->token);
    // $access_token='EAACeZCVjM7usBAE7qcz0JqhLFcNeTIYPo1VeX503bzF0IkzZAxVd1sGSEyduvlXq4t3iMfYIGVVRhFPXZBVabQGj4UcAjLcfnpJ1DuNhl1sJJobaHjFeRxHsguN1fnaFv3Ij7M7vaNPQGZB7licNHwRxZAoER6HeRw8uZBVro2zokilaBabul6c1hSBD6lejDkzZA5qo3bWSWi66jZAQaNuy';
    //     $fb->setDefaultAccessToken($access_token);
    //     $fields = "id,cover,name,first_name,last_name,hometown,age_range,birthday,location,likes,posts,friends,link,gender,email,name_format,locale,picture,timezone,updated_time,verified";
    //     $fb_user = $fb->get('/me?fields='.$fields)->getGraphNode();
    //     dd($fb_user);
        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            auth()->login($existingUser, true);
        } else {
            $newUser                    = new User;
            $newUser->provider_name     = 'facebook';
            $newUser->provider_id       = $user->getId();
            $newUser->name              = $user->getName();
            $newUser->email             = $user->getEmail();
            $newUser->email_verified_at = now();
            $newUser->avatar            = $user->getAvatar();
            $newUser->save();
    
            auth()->login($newUser, true);


        
    }
    return redirect()->route('/home');

    }
    

}
