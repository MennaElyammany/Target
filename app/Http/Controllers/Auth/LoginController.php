<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use App\InstagramMedia;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Google_Client;
use Google_Service_YouTube;
use Google_Service_People;
use GuzzleHttp\Client;




class LoginController extends Controller
{ 
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
