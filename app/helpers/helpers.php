<?php
use Illuminate\Support\Str;
use Alaouy\Youtube\Facades\Youtube;
use App\User;
 function fetch_youtube_data($url){
  
     if(Str::contains($url, '/user')){
        $channelName=substr($url,strpos($url,'user/')+5);
        $channel = Youtube::getChannelByName($channelName);
        // dd($channel);
        // if (!$channel)                  return view('influencers.create',['msg'=> 'Youtube channel does not exist.']);

        $channelId=$channel->id;

     }
     else if(Str::contains($url, '/channel'))
     {
    
        $channelId=substr($url,strpos($url,'channel/')+8);
        $channel = Youtube::getChannelById($channelId);
        // dd($channel);
        // if (!$channel)                       return redirect()->route('influencers.create');

       
     }
    
     $videoList = Youtube::listChannelVideos($channelId, 40);

  
     $verified=checkVerification($url);
     
     $channelData=$channel;
     $name=$channelData->snippet->title;
     $imageUrl=$channelData->snippet->thumbnails->medium->url;
     $imageUrlSmall=$channelData->snippet->thumbnails->default->url;

   
     if (isset($channelData->snippet->country)){   //check if country is set
      $country=$channelData->snippet->country;
     }
    else
     $country="Middle East";
     $views=$channelData->statistics->viewCount;
     $subscribers=$channelData->statistics->subscriberCount;
     if(!$subscribers) $subscribers=0;
     $videoCount=$channelData->statistics->videoCount;
     $about=$channelData->snippet->description;
     $activities=Youtube::getActivitiesByChannelId($channelId);
     if(!$activities) $subscriptions=0;
     else $subscriptions = count( $activities);
     $videoList = Youtube::listChannelVideos($channelId, 40); //fetch channel videos
     $videoInf=[];
     if ($videoList)
     {
    foreach($videoList as $index=>$video){
       
        $info = Youtube::getVideoInfo($video->id->videoId); //get each video Info
        $videoIframe=$info->player->embedHtml;
        $videoIframe=substr($videoIframe,strpos($videoIframe,'src'),-122);

        $videoViews=$info->statistics->viewCount;
        $videoLikes=$info->statistics->likeCount;
        $videoComments=$info->statistics->commentCount;
        $videoDislikes=$info->statistics->dislikeCount;
        
        $newVideo=new stdClass();
        $newVideo->videoIframe=$videoIframe;
        $newVideo->videoViews=$videoViews;
        $newVideo->videoLikes=$videoLikes;
        $newVideo->videoComments=$videoComments;
        $newVideo->videoDislikes=$videoDislikes;
        array_push($videoInf,$newVideo);           //generate array of objects of video info
       
    }
}
    
     $data=[
         'name'=>$name,
         'imageUrl'=>$imageUrl,
         'country'=>$country,
         'views'=>$views,
         'subscribers'=>$subscribers,
         'videoCount'=>$videoCount,
         'verified'=>$verified,
         'imageUrlSmall'=>$imageUrlSmall,
         'subscriptions'=>$subscriptions,
         'about'=>$about,
         'videoList'=>$videoInf,
     ];


     return $data;

}
function convertNumber($number){
    if($number>=1000000){
        $number=($number/1000000);
        if(is_float($number))
          $number=number_format($number,1);
       $number=$number .'M';
    }
    else if($number>=1000){
        $number=($number/1000);
        if(is_float($number))
        $number=number_format($number,1);
     $number=$number .'K';
    }
   
else
$number=$number;

return $number;
}

 function checkVerification($url){

    $key = 'has-badge';    //check if channel is verified by youtube
    $channelVerified = file_get_contents($url);
    
    if( stripos($channelVerified, $key) !== FALSE )
        return true ;
    else
    return false;
}
function listCountries(){
    $countries = DB::table('countries')->get();
    return $countries;
}
function listCategories(){
    $categories = DB::table('categories')->get();
    return $categories;
}
function getCountryName($id){
    $country_name = DB::table('countries')->where('id',$id)->get('country_name');
    return $country_name;
}
function getCategoryName($id){
    $category_name = DB::table('categories')->where('id',$id)->get('category_name');
    return $category_name;
}

 function redirectTo(){
        
    // User role
    $role = Auth::user()->role; 
    
    // Check user role
    switch ($role) {
        case 'influencer':
                return '/influencers/create';
            break;
        case 'client':
                return '/influencers';
            break; 
        default:
                return '/home'; 
            break;
    }
}
function findUser($id){
     $influencer= User::findOrFail($id);
return $influencer;
}
function findCountry($id){
    $country = DB::table('countries')->select('country_name')->where('id','=',$id)->get();
    
    return  $country[0]->country_name;
}


function get_unread_messages(){
    $messages=Auth::User()->unreadNotifications;
    return $messages;
}
function get_all_messages(){
    $messages=Auth::User()->notifications;
    return $messages;
}