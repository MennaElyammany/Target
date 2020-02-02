<?php
use Illuminate\Support\Str;
use Alaouy\Youtube\Facades\Youtube;
use App\User;
header('Content-Type: application/json');
$aResult = array();
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
    
     $videoList = Youtube::listChannelVideos($channelId, 1);

  
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
if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

if( !isset($aResult['error']) ) {

    switch($_POST['functionname']) {
        case 'fetch_youtube_data':
           if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 2) ) {
               $aResult['error'] = 'Error in arguments!';
           }
           else {
               $aResult['result'] = fetch_youtube_data(floatval($_POST['arguments'][0]));
           }
           break;

        default:
           $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
           break;
    }

}

echo json_encode($aResult);