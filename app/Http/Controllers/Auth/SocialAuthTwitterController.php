<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Http\Controllers\Controller;
use Socialite;

use Illuminate\Http\Request;

class SocialAuthTwitterController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('twitter')->redirect();
    }
    /**
     * Return a callback method from twitter api.
     *
     * @return callback URL from twitter
     */
    public function callback()
    {
        $user = Socialite::driver('twitter')->user(); 
        //$user = $this->userFromToken($token);
        //$user = Socialite::driver('twitter')->userFromTokenAndSecret($oauth_token, $oauth_verifier);
        dd($user->name);        
        // $user = $this->createUser($getInfo,'twitter'); 
        // auth()->login($user); 
        // return redirect()->to('/home');
        // return redirect()->route('influencers.index');
       
    }
    // public function userFromTokenAndSecret($token, $secret)
    // {
    //     $tokenCredentials = new TokenCredentials();

    //     $tokenCredentials->setIdentifier($token);
    //     $tokenCredentials->setSecret($secret);

    //     $user = $this->mapUserToObject((array)$this->server->getUserDetails($tokenCredentials));

    //     $user->setToken($tokenCredentials->getIdentifier(), $tokenCredentials->getSecret());

    //     return $user;
    // }
    function createUser($getInfo,$provider){
 
        $user = User::where('provider_id', $getInfo->id)->first();
    
        if (!$user) {
            $user = User::create([
               'name'     => $getInfo->name,
               'email'    => $getInfo->email,
               'provider_name' => $provider,
               'provider_id' => $getInfo->id
           ]);
         }
         dd($user);
         //return $user;
         return redirect()->to('/home');
      }
}
