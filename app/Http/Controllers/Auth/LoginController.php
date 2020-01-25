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
    {      
        //   session_start();

        return Socialite::driver('facebook')->redirect();
    }
    public function handleProviderFacebookCallback()
    {
        // session_start();
    
         $user = Socialite::driver('facebook')->user();
        // dd($user);
        $fb=new Facebook(config('facebook.config'));
        // $response = $fb->get('/me', $user->token);
    // $access_token='EAACeZCVjM7usBAE7qcz0JqhLFcNeTIYPo1VeX503bzF0IkzZAxVd1sGSEyduvlXq4t3iMfYIGVVRhFPXZBVabQGj4UcAjLcfnpJ1DuNhl1sJJobaHjFeRxHsguN1fnaFv3Ij7M7vaNPQGZB7licNHwRxZAoER6HeRw8uZBVro2zokilaBabul6c1hSBD6lejDkzZA5qo3bWSWi66jZAQaNuy';
        $fb->setDefaultAccessToken($user->token);
        $fields = "id,cover,name,first_name,last_name,hometown,age_range,birthday,location,likes,posts,friends,link,gender,email,name_format,locale,picture,timezone,updated_time,verified";
        $fb_user = $fb->get('/me?fields='.$fields)->getGraphNode();
        // dd($fb_user);
        // $accessToken=$user->token;
        // $helper = $fb->getRedirectLoginHelper();
        // $accessToken = $helper->getAccessToken();
        // $oAuth2Client = $fb->getOAuth2Client();
        // if (! $accessToken->isLongLived()) {
        //     // Exchanges a short-lived access token for a long-lived one
        //     try {
        //       $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
        //     } catch (Facebook\Exceptions\FacebookSDKException $e) {
        //       echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
        //       exit;
        //     }
          
        //     echo '<h3>Long-lived</h3>';
        //     var_dump($accessToken->getValue());
        //   }

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
            $newUser->country_id        = 1;
            $newUser->category_id        = 1;
            $newUser->role              = 'influencer';
            $newUser->facebook_token    =$user->token;
            $newUser->save();
    
            auth()->login($newUser, true);

        
    }
dd($fb_user);
    }
    

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
    

}
