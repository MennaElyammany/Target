<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Google_Client;
// use Google_Service_YouTube;
use Google_Service_People;


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
    {           //my code
        session(['role' => $request->role]);
        return Socialite::driver('google')->redirect();
        
            //internet code        
        // return Socialite::driver('google')
        // ->scopes(['openid', 'profile', 'email', Google_Service_People::CONTACTS_READONLY])
        // ->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderGoogleCallback()
    {  $role=session('role');
        $user = Socialite::driver('google')->stateless()->user();
        //from internet
        // $user = Socialite::driver('google')->user();
        // // Set token for the Google API PHP Client
        // $google_client_token = [
        //     'access_token' => $user->token,
        //     'refresh_token' => $user->refreshToken,
        //     'expires_in' => $user->expiresIn
        // ];
    
        // $client = new Google_Client();
        // $client->setApplicationName("Laravel");
        // $client->setDeveloperKey(env('GOOGLE_SERVER_KEY'));
        // $client->setAccessToken(json_encode($google_client_token));
    
        // $service = new Google_Service_People($client);
    
        // $optParams = array('requestMask.includeField' => 'person.phone_numbers,person.names,person.email_addresses');
        // $results = $service->people_connections->listPeopleConnections('people/me',$optParams);
    
        // dd($results);

        //my code

        
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

    // public function listYouTubeChannel($token,$user) {
    //     $client = new Google_Client();
    //         // Set token for the Google API PHP Client
    // $google_client_token = [
    //     'access_token' => $user->token,
    //     'refresh_token' => $user->refreshToken,
    //     'expires_in' => $user->expiresIn
    // ];
    //     // $client->setDeveloperKey(env('GOOGLE_SERVER_KEY'));
    //     $client->setApplicationName('Iti Blog');
    //     $client->setScopes('https://www.googleapis.com/auth/youtube.readonly');
    //     // Set to name/location of your client_secrets.json file.
    //     $client->setAuthConfig('C:\Users\HP\Documents\GitHub\Target\app\Http\Controllers\Auth\client_secret.json');
    //     $client->setAccessToken(json_encode($google_client_token));
    //     $service = new Google_Service_YouTube($client);
    //     $params = array_filter(array('mine' => true));
    //     $response = $service->channels->listChannels('snippet,contentDetails,statistics',$params);
    //     dd($response);
    // }
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
