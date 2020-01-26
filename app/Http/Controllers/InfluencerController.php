<?php

namespace App\Http\Controllers;
use View;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInfluencerRequest;
use App\User;
use Auth;




class InfluencerController extends Controller
{
    function index(){

        return view('influencer.index');
    }
    function show($id)
    {
        // $data= fetch_youtube_data('https://www.youtube.com/channel/UC3gVtE-5etYKM-cdzBY225A');

        // return view('influencers.showYoutube',['data'=>$data]);
    }
    function create()

    {   $countries= listCountries();
        $categories= listCategories();
        $influencer=Auth::user();
        return View::make('influencers.create',['countries' => $countries,'categories'=>$categories,'influencer'=>$influencer]);
    }
    function store(StoreInfluencerRequest $request){
        $influencer = Auth::user();
        $influencer->country_id = $request->country_id;
        $influencer->category_id = $request->category_id;
        $influencer->role = $request->role;
        $influencer->youtube_url = $request->youtube_url;
        $influencer->save();
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
