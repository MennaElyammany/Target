<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Facebook\Facebook;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function redirectToProviderFacebook(request $request)
    {       //   session_start();
        session(['role' => $request->role]);
        return Socialite::driver('facebook')->redirect();
    }
    public function handleProviderFacebookCallback()
    {
        // session_start();
         $user = Socialite::driver('facebook')->stateless()->user();
         $role=session('role');
        // dd($user);
        $fb=new Facebook(config('facebook.config'));
        $fb->setDefaultAccessToken($user->token);
        $fields = "id,cover,name,first_name,last_name,hometown,age_range,birthday,location,likes,posts,friends,link,gender,email,name_format,locale,picture,timezone,updated_time,verified";
        $fb_user = $fb->get('/me?fields='.$fields)->getGraphNode();

        $existingUser = User::where('email', $user->getEmail())->first();
        if ($existingUser) {
            auth()->login($existingUser, true);
            return redirect()->route('influencers.index');

        } else {
            if(!empty($role)){
            $newUser                    = new User;
            $newUser->provider_name     = 'facebook';
            $newUser->provider_id       = $user->getId();
            $newUser->name              = $user->getName();
            $newUser->email             = $user->getEmail();
            $newUser->email_verified_at = now();
            $newUser->avatar            = $user->getAvatar();
            $newUser->facebook_token    =$user->token;
            $newUser->role= $role;
            $newUser->save();
            auth()->login($newUser, true);
            return redirect(redirectTo());
            }
            else
      return view('auth.login',['msg'=> 'You are not regitered.']);
           }
    }

    public function redirectToProviderGoogle(request $request)
    {
        session(['role' => $request->role]);
        return Socialite::driver('google')->redirect();
        
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderGoogleCallback()
    {    $role=session('role');
        $user = Socialite::driver('google')->user();
        // dd($user);
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
            $newUser->avatar            = $user->getAvatar();
            $newUser->role= $role;
            $newUser->save();
            auth()->login($newUser, true);
            return redirect(redirectTo());
        }
        else
  return view('auth.login',['msg'=> 'You are not regitered.']);
       }
    }

    

    use AuthenticatesUsers;

    public function redirectTo(){
        
        // User role
        $role = Auth::user()->role; 
        
        // Check user role
        switch ($role) {
            case 'influencer':
                    return '/influencers/create';
                break;
            case 'client':
                    return '/influencers';
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
