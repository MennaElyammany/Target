<?php

namespace App\Http\Controllers;
use View;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInfluencerRequest;
use App\User;
use App\InstagramMedia;
use TwitterAPIExchange;
use Auth;
use Session;
use willvincent\Rateable\Rateable;
use willvincent\Rateable\Rating;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class InfluencerController extends Controller
{
    
    function index(Request $request){        
        $influencers = User::where('role','Influencer');
        if(request()->has('category_id')){
            $influencers = $influencers->where('category_id',request('category_id'));
        }
        if(request()->has('country_id')){
            $influencers = $influencers->where('country_id',request('country_id'));
        }
        if(request()->has('sort')){
            $influencers = $influencers->orderBy('followers',request('sort'));
        }
    $influencers = $influencers->paginate(10)
                    ->appends([
                        'category_id' => request('category_id'),
                        'country_id' => request('country_id'),
                        'sort'=>request('sort')
                    ]);
                   
        return view('influencers.index',compact('influencers'));
    }

    function show($id)
    { 
    $influencer= User::findOrFail($id);
    if( Redis::ttl($id)<=0)
    $data=fetch_youtube_data($influencer->youtube_url);
    else
    $data=json_decode(Redis::get($id),true);
    $url=$influencer['youtube_url'];
    $data['influencer_id']=$id;     
     return view('influencers.showYoutube',['data'=>$data,'id'=>$id]);
    }
    function showYoutubeModal(Request $request)
    {   
        $data = fetch_youtube_data($request->url);
        return $data;
    }
    

    function showInstagram($id)
    {  
        $influencer= User::findOrFail($id);
        $media_list = InstagramMedia::where('instagram_id', $influencer['instagram_id'])->get();
        $media_url_list=[];
        foreach($media_list as $media_item)
        {
        array_push($media_url_list,($media_item['media_url']));
        }
        // dd($media_url_list);
        return $media_url_list;
     //return view('influencers.showInstagram',['media_url_list'=>$media_url_list,'id'=>$id]);
    }

function showTwitter($id){
    $influencer = User::findOrFail($id);
    $twitterPosts = $influencer->twitterPosts;
    $tweets = [];
    foreach($twitterPosts as $tweet){
        array_push($tweets,($tweet));
    }
    return $tweets;

}
function postTwitterView(){
    return view('influencers.postTweets');
}
function sendTweet(Request $request){
    $settings = array(
        'oauth_access_token' => $request->session()->get('TWITTER_ACCESS_TOKEN'),
        'oauth_access_token_secret' => $request->session()->get('TWITTER_ACCESS_TOKEN_SECRET'),
        'consumer_key' => env('TWITTER_CONSUMER_KEY'),
        'consumer_secret' => env('TWITTER_CONSUMER_SECRET')
        ); 
    $posturl = 'https://api.twitter.com/1.1/statuses/update.json';
    $requestMethod = 'POST';
    $postfields = array(
        'status' => $request->status,
    );
    $twitterpost = new TwitterAPIExchange($settings);
    $twitterpost->buildOauth($posturl, $requestMethod)
                 ->setPostfields($postfields)
                 ->performRequest();

    return redirect()->route('influencers.index');
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
        if(isset($request->youtube_url))
        {
        $influencer->youtube_url = $request->youtube_url;
        $influencer_data = fetch_youtube_data($request->youtube_url);
        $influencer->verified = $influencer_data['verified']?1:0;
        $influencer->youtube_avatar = $influencer_data['imageUrl'];
        $influencer->youtube_followers = $influencer_data['subscribers'];
        if($influencer->avatar==null||$influencer->avatar==asset('default.png'))
        {
        $influencer->avatar==$influencer_data['imageUrl'];
        }
        if ($influencer->followers==null)
        {
        $influencer->followers== $influencer_data['subscribers'];
        }
        Redis::setex(Auth::user()->id,60*60*48, json_encode($influencer_data));
        }
    

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
    function test(){
        $num=roundAverageRating(2.5000);
        dd($num);
        return view('test');
    }

}
