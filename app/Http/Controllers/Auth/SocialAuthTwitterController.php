<?php

namespace App\Http\Controllers\Auth;
use Auth;
use App\User;
use App\TwitterPost;
use App\Http\Controllers\Controller;
use Socialite;
use Validator,Redirect,Response,File;
use TwitterAPIExchange;
use Illuminate\Http\Request;

class SocialAuthTwitterController extends Controller
{
    public function redirect(Request $request)
    {
        session(['role' => $request->role]);
        return Socialite::driver('twitter')->redirect();
    }
    /**
     * Return a callback method from twitter api.
     *
     * @return callback URL from twitter
     */
    public function callback(Request $request)
    {
        $userInfo = Socialite::driver('twitter')->user(); 
        $role=session('role');
        $existingUser = User::where('twitter_id',$userInfo->id.'@gmail.com')->first();
        if ($existingUser) {
            auth()->login($existingUser, true);
            return redirect()->route('influencers.index');
        }
        else{
            if(!empty($role)){
        $role=session('role');   
        $newUser                    = new User;
        $newUser->provider_name     = 'twitter';
        //$newUser->provider_id       = $userInfo->id;
        $newUser->twitter_id        = $userInfo->id;
        $newUser->name              = $userInfo->name;
        $newUser->email             = $userInfo->id.'@twitter.com';
        $newUser->email_verified_at = now();
        $newUser->avatar            = $userInfo->avatar;
        $newUser->role= $role;
        $newUser->save();
        auth()->login($newUser, true);
        $newUser->assignRole($newUser->role);  //assign role
        //getting tweets
        $tweets = $this->retrieveTweets($userInfo->token,$userInfo->tokenSecret);
        //dd($tweets);
        //dd($tweets[0]['id']);
        //saving tweets
        $user = User::where('id',$newUser->id);
        foreach($tweets as $tweet){
        $twitterPost = new TwitterPost;
        $twitterPost->tweet_id = $tweet['id'];
        $twitterPost->text = $tweet['text'];
        $twitterPost->favorite_count = $tweet['favorite_count'];
        $twitterPost->retweet_count = $tweet['retweet_count'];
        $twitterPost->user_id = $newUser->id;
        $twitterPost->save();
        return redirect(redirectTo());
        }
            }
        else
        return view('auth.login',['msg'=> 'You are not regitered.']);
        }
        
        //posting tweet
        //$postTweet = $this->postTweet($userInfo->token,$userInfo->tokenSecret);


        // if($postTweet->httpStatusCode==200){
        //     dd("success");
        // }
        // else{
        //     dd("error");
        // }
        // $engagementUrl = 'https://data-api.twitter.com/insights/engagement/totals';
        // $method = 'POST';
        // $engagement = new TwitterAPIExchange($settings);
        // //json_decode($response->content(), true);
        // $postfields = array(   
            
        //     'Accept-Encoding: gzip',
        //     'tweet_ids:1217776265337475073'
                     
        //         // "tweet_ids" : "1217776265337475073",
        //         //     "1217183078503845893",
        //         //     "1174437703146004480"
        //         // ),
        //         // "engagement_types" => array( 
        //         //     "impressions",
        //         //     "engagements",
        //         //     "favorites"),
        //         // "groupings" => "grouping name" =>array(
        //         //     "group_by"=>array(
        //         //       "tweet.id",
        //         //       "engagement.type"
        //         //     )
        //         // )
        //     );
        // $engagements =  $engagement->buildOauth($engagementUrl, $method)
        // ->setPostfields($postfields)
        // ->performRequest();
        // dd($engagements);

        //$user = Socialite::driver('twitter')->userFromTokenAndSecret('1048707230667816961-CnnlB8b0pQCbBGz6P8Q1QGuvkyG6tl', 'kK5GgJq2ja1O60eSNkxMeiXhl0CAt9clKYd8pHVMLavm3');
        //dd($userInfo->id); 


        
       
    }
    function retrieveTweets($token,$tokenSecret){
        $settings = array(
            'oauth_access_token' => $token,
            'oauth_access_token_secret' => $tokenSecret,
            'consumer_key' => env('TWITTER_CONSUMER_KEY'),
            'consumer_secret' => env('TWITTER_CONSUMER_SECRET')
            );   
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?count=20';
        $requestMethod = 'GET';
    
        $twitter = new TwitterAPIExchange($settings);
        $tweets =  $twitter->setGetfield($getfield)
                ->buildOauth($url, $requestMethod)
                ->performRequest();
            
            
                $tweets = json_decode($tweets,true);
                return $tweets;
    }
    function postTweet($token,$tokenSecret){
        $settings = array(
            'oauth_access_token' => $token,
            'oauth_access_token_secret' => $tokenSecret,
            'consumer_key' => env('TWITTER_CONSUMER_KEY'),
            'consumer_secret' => env('TWITTER_CONSUMER_SECRET')
            ); 
        $posturl = 'https://api.twitter.com/1.1/statuses/update.json';
        $requestMethod = 'POST';
        $postfields = array(
            'status' => 'hello',
        );
        $twitterpost = new TwitterAPIExchange($settings);
        $twitterpost->buildOauth($posturl, $requestMethod)
                     ->setPostfields($postfields)
                     ->performRequest();
        return $twitterpost;
        //return "You tweeted a new post";
    }
}
