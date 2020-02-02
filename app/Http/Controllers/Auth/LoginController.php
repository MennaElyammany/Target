<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_YouTube;
use Google_Service_People;
use GuzzleHttp\Client;




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
        $fb=new Facebook(config('facebook.config'));
        $fb->setDefaultAccessToken('EAACeZCVjM7usBABvZCyTbo4weLmTagIJxpeVKxZBYBmtM92bca0X6lRrriK6tlGuZANapfr82wAUrMCtAMTv0l0BfPqq1eTjWi4SyRkJP2Ta2ZBitTXnGTnGZAE6J6Me98OiHbRQbtbZCoATAFO1Pooheh4DqMCuo65c21rngptNHugaZAKgZBcl63JL0rnK5LJgZBN4GpuJzEhQZDZD');
        $fields = "instagram_basic,friends,link,gender,email,name_format,locale,picture,timezone,updated_time,verified";
        $fb_user = $fb->get('/me?fields='.$fields)->getGraphUser();
        dd($fb_user);
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
            $newUser->assignRole($newUser->role);  //assign role
            return redirect(redirectTo());
            }
            else
      return view('auth.login',['msg'=> 'You are not regitered.']);
           }
    }

    public function redirectToProviderGoogle(request $request)
    {           //my code
         session(['role' => $request->role]);
         return Socialite::driver('google')->stateless()->redirect();


        // return Socialite::driver('google')
        // ->scopes(['openid', 'profile', 'email', Google_Service_People::CONTACTS_READONLY])
        // ->stateless()->redirect();
        
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderGoogleCallback()
    {  $role=session('role');
       $user = Socialite::driver('google')->stateless()->user();
        
    //    $google_client_token = [
    //     'access_token' => $user->token,
    //     'refresh_token' => $user->refreshToken,
    //     'expires_in' => $user->expiresIn
    // ];
    // $client = new Google_Client();
    // $client->setApplicationName("Target");
    // $client->setDeveloperKey(env('AIzaSyDBxjOliE14c7W4s5_gw9PuaqKPEXWhLQQ'));
    // $client->setAccessToken(json_encode($google_client_token));

    // $service = new Google_Service_People($client);

    // $optParams = array('requestMask.includeField' => 'person.phone_numbers,person.names,person.email_addresses');
    // $results = $service->people_connections->listPeopleConnections('people/me',$optParams);

    // dd($results);
       
    
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
            $newUser->assignRole($newUser->role);  //assign role
            return redirect(redirectTo());
        }
        else
  return view('auth.login',['msg'=> 'You are not regitered.']);
       }

    }
    


    public function redirectToInstagramProvider()
    {
        $appId = config('services.instagram.client_id');
        $redirectUri = urlencode(config('services.instagram.redirect'));
        return redirect()->to("https://api.instagram.com/oauth/authorize?app_id={$appId}&redirect_uri={$redirectUri}&scope=user_profile,user_media&response_type=code");
    }
    
    public function instagramProviderCallback(Request $request)
    {
        $code = $request->code;
        if (empty($code)) return redirect()->route('home')->with('error', 'Failed to login with Instagram.');
    
        $appId = config('services.instagram.client_id');
        $secret = config('services.instagram.client_secret');
        $redirectUri = config('services.instagram.redirect');
    
        $client = new Client();
    
        // Get access token
        $response = $client->request('POST', 'https://api.instagram.com/oauth/access_token', [
            'form_params' => [
                'app_id' => $appId,
                'app_secret' => $secret,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $redirectUri,
                'code' => $code,
            ]
        ]);
    
        if ($response->getStatusCode() != 200) {
            return redirect()->route('home')->with('error', 'Unauthorized login to Instagram.');
        }
    
        $content = $response->getBody()->getContents();
        $content = json_decode($content);
    
        $accessToken = $content->access_token;
        $userId = $content->user_id;
    
        // Get user info
        $response = $client->request('GET', "https://graph.instagram.com/me?fields=id,username,media,account_type&access_token={$accessToken}");
    
        $content = $response->getBody()->getContents();
        $oAuth = json_decode($content);    
        // Get instagram user name 
        $username = $oAuth->username;
    
dd($oAuth);
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
