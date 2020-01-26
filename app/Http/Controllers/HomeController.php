<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {  
          $data= fetch_youtube_data('https://www.youtube.com/channel/UC3gVtE-5etYKM-cdzBY225A');
        
          
        return view('influencers.showYoutube',['data'=>$data]);
    }

}
