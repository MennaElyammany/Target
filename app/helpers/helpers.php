<?php
use Illuminate\Support\Str;
use Alaouy\Youtube\Facades\Youtube;
use App\User;
use willvincent\Rateable\Rateable;
use App\Request;



function fetch_youtube_data($url){
    if(Str::contains($url, '/user')){
       $channelName=substr($url,strpos($url,'user/')+5);
       $channel = Youtube::getChannelByName($channelName);
      
       $channelId=$channel->id;

    }
    else if(Str::contains($url, '/channel'))
    {
   
       $channelId=substr($url,strpos($url,'channel/')+8);
       $channel = Youtube::getChannelById($channelId);
   
    }
   
    
    
    $videoList = Youtube::listChannelVideos($channelId,40);
 
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
    if(!$subscribers)
    $subscribers=0;
    $videoCount=$channelData->statistics->videoCount;
    $about=$channelData->snippet->description;
    $activities=Youtube::getActivitiesByChannelId($channelId);
    if(count($activities)==0) 
    $subscriptions=0;
    else 
    $subscriptions = count( $activities);
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
$number=$number?$number:0;

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
        case 'Influencer':
                return '/influencers/create';
            break;
        case 'Client':
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
function has_uncompleted_request($id){
  
    $requests=Auth::User()->Requests;
    $completed=true;
foreach($requests as $request)
{
    if($request->influencer_id==$id && $request->status!="paid" && $request->status!="declined" )
    $completed=false;
}
return $completed;
}

function calcEngagement($channel){
    $views=$channel['views'];
    $subscribers=$channel['subscribers'];
    $videos = $channel['videoList'];
    $likes_array=array();
    $dislikes_array=array();
    $views_array=array();
    $comments_array=array();
    $videos_count=0;
    foreach($videos as $video){
        $video=json_decode(json_encode($video,true));
        $likes_per_video= $video->videoLikes;
        $dislikes_per_video= $video->videoDislikes;
        $views_per_video= $video->videoViews;
        $comments_per_video= $video->videoComments;
        array_push($likes_array,$likes_per_video);
        array_push($dislikes_array,$dislikes_per_video);
        array_push($views_array,$views_per_video);
        array_push($comments_array,$comments_per_video);
        $videos_count++;
    }
    $likes_sum =0;
    foreach($likes_array as $count){
        $likes_sum=$count+$likes_sum;

    }
    $dislikes_sum =0;
    foreach($dislikes_array as $count){
        $dislikes_sum=$count+$dislikes_sum;

    }
    $views_sum =0;
    foreach($views_array as $count){
        $views_sum=$count+$views_sum;

    }
    $comments_sum =0;
    foreach($comments_array as $count){
        $comments_sum=$count+$comments_sum;

    }

    $engagement_rate = round((($likes_sum+$dislikes_sum+$comments_sum)/$views_sum)*100,1,PHP_ROUND_HALF_UP);
    $avg_views=convertNumber(round($views_sum/$videos_count));
    $avg_likes=convertNumber(round($likes_sum/$videos_count));
    $avg_comments=convertNumber(round($comments_sum/$videos_count));
    return $value= [
        'engagement'=> $engagement_rate,
        'averageViews'=>$avg_views,
        'averageLikes'=>$avg_likes,
        'averageComments'=>$avg_comments
];

};
function findClientName($id){
    $client=User::find($id);
    return $client->name;
}


function findUserAvatar($id){
    $user=User::find($id);
    return $user->avatar;
}
function roundAverageRating($num){
    $averageRating = round( $num, 1, PHP_ROUND_HALF_DOWN);
    return $averageRating;
}


function getRequestbyId($id){
    $request=Request::find($id);
    return $request;
}

function checkIfRated($rateable_id,$request_id){
    $user_id=Auth::user()->id;
    $rating=User::find($rateable_id)->ratings->where('request_id','=',$request_id)->where('user_id','=',$user_id);
    if($rating->first()){
        return 'yes';
    }    
    else{
        return 'no';
    }      
}

function calcInstagramEngagement($id){
        $likes= DB::table('instagram_media')->where('user_id','=',$id)->pluck('like_count');
        $comments=DB::table('instagram_media')->where('user_id','=',$id)->pluck('comments_count');
        $likes_sum =0;
        $comments_sum=0;
        $impressions_sum=0;
        $likes_counter=0;
        $comments_counter=0;
        foreach($likes as $like){
            $likes_sum = $likes_sum + $like;
            $likes_counter++;
        }
        foreach($comments as $comment){
            $comments_sum = $comments_sum +$comment;
            $comments_counter++;
        }
        $user = User::findOrFail($id);
        $followers = $user->followers;
        $engagement = round(($likes_sum+$comments_sum)/$followers,1,PHP_ROUND_HALF_UP);
        $averageLikes = round($likes_sum/$likes_counter);
        $averageComments = round($comments_sum/$comments_counter);

        return $result=[
            'engagement'=> $engagement,
            'averageLikes'=>$averageLikes,
            'averageComments'=>$averageComments
        ];
           // $impressions= DB::table('instagram_insights')->where('influencer_id','=',$id)->pluck('impressions_value');
        // foreach($impressions as $impression){
        //     $impressions_sum = $impressions_sum +$impression;
        // }
}
 