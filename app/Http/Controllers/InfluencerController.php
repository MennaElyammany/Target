<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfluencerController extends Controller
{
    function index(){

        return view('influencer.index');
    }
    function show($id)
    {
        $data= fetch_youtube_data('https://www.youtube.com/channel/UC3gVtE-5etYKM-cdzBY225A');

        return view('influencers.showYoutube',['data'=>$data]);
    }
    function create()

    {   $countries= listCountries();
        $categories= listCategories();
        return view('influencers.create',['countries' => $countries,'categories'=>$categories]);
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
