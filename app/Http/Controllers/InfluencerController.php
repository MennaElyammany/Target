<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfluencerController extends Controller
{
    function index(){

        return view('influencer.index');
    }
    function show($id)
    {   $influencer= User::findOrFail($id);
        $url=$influencer['youtube_url'];
        $data= fetch_youtube_data($url);

        return view('influencers.showYoutube',['data'=>$data]);
    }
    function create()
    {
        return view('influencers.create');
    }
    function store($request){

        return redirect()->route('influencers.index');
    }
    function edit($id)
    {
        return view('influencers.edit', ['influencer' => User::findOrFail($id)]);
    }
    
    function destroy($id)
    {
        $influencer=User::findOrFail($id);
        
     
        $influencer->delete();
        
        return redirect()->route('influencers.index');
        
    }
}
