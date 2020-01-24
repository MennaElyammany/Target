<?php
use Illuminate\Support\Str;
use Alaouy\Youtube\Facades\Youtube;


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
     
     $channelData=$channel;
     $videoList = Youtube::listChannelVideos($channelId, 40);

     $name=$channelData->snippet->title;
     $imageUrl=$channelData->snippet->thumbnails->medium->url;
     $country=$channelData->snippet->country;
     $views=$channelData->statistics->viewCount;
     $subscribers=$channelData->statistics->subscriberCount;
     
     $videoCount=$channelData->statistics->videoCount;
     $activities = Youtube::getActivitiesByChannelId($channelId);

     $data=[
         'name'=>$name,
         'imageUrl'=>$imageUrl,
         'country'=>$country,
         'views'=>$views,
         'subscribers'=>$subscribers,
         'videoCount'=>$videoCount,
     ];
     return $data ;

}