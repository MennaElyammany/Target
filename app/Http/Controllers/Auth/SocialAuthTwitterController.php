<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Http\Controllers\Controller;
use Socialite;
use Validator,Redirect,Response,File;

use Illuminate\Http\Request;

class SocialAuthTwitterController extends Controller
{
    public function redirect(Request $request)
    {
        session(['role' => $request->role]);
        return Socialite::driver('twitter')->redirect();
    }
    /**
     * Return a callback method from twitter api.
     *
     * @return callback URL from twitter
     */
    public function callback(Request $request)
    {
        //dd($request->oauth_token);
        $user = Socialite::driver('twitter')->user(); 
        //$user = Socialite::driver('twitter')->userFromTokenAndSecret('1048707230667816961-CnnlB8b0pQCbBGz6P8Q1QGuvkyG6tl', 'kK5GgJq2ja1O60eSNkxMeiXhl0CAt9clKYd8pHVMLavm3');
        dd($user); 
        $role=session('role');   
        //dd($user->name);    
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
