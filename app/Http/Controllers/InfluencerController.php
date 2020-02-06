<?php

namespace App\Http\Controllers;
use View;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInfluencerRequest;
use App\User;
use App\InstagramMedia;
use Auth;
use Session;
use willvincent\Rateable\Rateable;
use willvincent\Rateable\Rating;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\carbon;

class InfluencerController extends Controller
{
    
    function index(Request $request){   
       
        $influencers = User::where('role','Influencer')->where('youtube_url','!=',NULL);
      
        if(request()->has('category_id')){
            $influencers = $influencers->where('category_id',request('category_id'));
        }
        if(request()->has('country_id')){
            $influencers = $influencers->where('country_id',request('country_id'));
        }
    $influencers = $influencers->paginate(10)
                    ->appends([
                        'category_id' => request('category_id'),
                        'country_id' => request('country_id'),
                    ]);
                   
        return view('influencers.index',compact('influencers'));
    }

    function show($id)
    {  

    $influencer= User::findOrFail($id);

    if( Redis::ttl($id)<=0){
    $data=fetch_youtube_data($influencer->youtube_url);
    Redis::setex($id,60*60*48, json_encode($data));
     $influencer->updated_at=now();
     $influencer->save();
    }
   else
   $data=json_decode(Redis::get($id),true); 

        $url=$influencer['youtube_url'];
        $data['influencer_id']=$id;

      
     return view('influencers.showYoutube',['data'=>$data,'id'=>$id]);
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

     return view('influencers.showInstagram',['media_url_list'=>$media_url_list,'id'=>$id]);
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
        $influencer->youtube_url = $request->youtube_url;
        $influencer_data = fetch_youtube_data($request->youtube_url);
        $influencer->verified = $influencer_data['verified']?1:0;
        $influencer->avatar = $influencer_data['imageUrl'];
        $influencer->followers = $influencer_data['subscribers'];
        $influencer->save();
        Redis::setex(Auth::user()->id,60*60*48, json_encode($influencer_data));

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
