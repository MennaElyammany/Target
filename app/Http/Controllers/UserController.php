<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function index(Request $request){
        if(request()->has('category_id')){
            $users = User::where('role','Influencer')
            ->where('category_id',request('category_id'))->paginate(1)
            ->appends('category_id',request('category_id'));
         }
        else{
            $users = User::where('role','Influencer')->paginate(2);
        }
        return view('influencers.index',['influencers' => $users]);
        }

    // function store(Request $request){
    //     $influencer = new User();
    //     $channelURL = fetch_youtube_data($request->$url);
    // }
    
    
}
