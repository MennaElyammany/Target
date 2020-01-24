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

     $videoList = Youtube::listChannelVideos($channelId, 40);


     $key = 'has-badge';    //check if channel is verified by youtube
     $channelVerified = file_get_contents($url);
     
     if( stripos($channelVerified, $key) !== FALSE )
         $verified=true ;
     else
     $verified=false;
     
     $channelData=$channel;
     $name=$channelData->snippet->title;
     $imageUrl=$channelData->snippet->thumbnails->medium->url;

   
     if (isset($channelData->snippet->country)){   //check if country is set
      $country=$channelData->snippet->country;
     }
    else
     $country="Middle East";
     $views=$channelData->statistics->viewCount;
     $subscribers=$channelData->statistics->subscriberCount;
     $videoCount=$channelData->statistics->videoCount;

     $data=[
         'name'=>$name,
         'imageUrl'=>$imageUrl,
         'country'=>$country,
         'views'=>$views,
         'subscribers'=>$subscribers,
         'videoCount'=>$videoCount,
         'verified'=>$verified
     ];


     return $data;

}