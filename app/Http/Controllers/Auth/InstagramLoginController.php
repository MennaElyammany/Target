<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use App\InstagramMedia;
use GuzzleHttp\Client;

class InstagramLoginController extends Controller
{
  
    public function redirectToInstagramProvider(request $request)
    {
        session(['role' => $request->role]);
        $appId = config('services.instagram.client_id');
        $redirectUri = urlencode(config('services.instagram.redirect'));
        return redirect()->to("https://api.instagram.com/oauth/authorize?app_id={$appId}&redirect_uri={$redirectUri}&scope=user_profile,user_media&response_type=code");
    }
    
    public function instagramProviderCallback(Request $request)
    {
        $role=session('role');
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
        $instagramId = $content->user_id;

        // save user in users table
        $existingUser = User::where('instagram_id', $instagramId)->first();
        if ($existingUser) {
            auth()->login($existingUser, true);
            return redirect()->route('influencers.index');
        } else {
            if(!empty($role)){
        // Get user info
        $response = $client->request('GET', "https://graph.instagram.com/me?fields=id,username,media,account_type&access_token={$accessToken}");
        $content = $response->getBody()->getContents();
        $user = json_decode($content);   
        $user_name=$user->username; 
            $newUser                    = new User;
            $newUser->provider_name     = 'instagram';
            // $newUser->provider_id       = $user->getId();
            $newUser->name              = $user->username;
            // $newUser->email             = $user->getEmail();
            $newUser->email             = $instagramId.'@instagram.com';
            $newUser->email_verified_at = now();
            $newUser->instagram_avatar            = asset('default.png');
            $newUser->role= $role;
            $newUser->instagram_id=$instagramId;
            $newUser->save();
            auth()->login($newUser, true);
            $newUser->assignRole($newUser->role);  //assign role

            //get and save this user media urls
            $media_list=$user->media->data;
            foreach($media_list as $media_item)  
            {
                $newMedia                   = new InstagramMedia;
                $media_id=$media_item->id;
                $imgResponse = $client->request('GET',"https://graph.instagram.com/{$media_id}?fields=media_url&access_token={$accessToken}");
                $img_url= json_decode($imgResponse->getBody()->getContents());
                $newMedia->media_id= $media_id;
                $newMedia->media_url=$img_url->media_url;
                $newMedia->user_id=$newUser->id;
                $newMedia->instagram_id=$instagramId;
                $newMedia->save();
                      }


            return redirect(redirectTo());
        }
        else
  return view('auth.login',['msg'=> 'You are not regitered.']);
       }

        // return view('influencers.showInstagram',['media_url_list'=>$media_url_list]);

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
