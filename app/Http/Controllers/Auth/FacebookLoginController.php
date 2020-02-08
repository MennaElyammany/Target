<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use App\InstagramMedia;
use App\InstagramAccount;
use Facebook\Facebook;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class FacebookLoginController extends Controller
{
    public function redirectToProviderFacebook(request $request)
    {       //   session_start();
        session(['role' => $request->role]);
        return Socialite::driver('facebook')->fields([
            'first_name', 'last_name', 'email', 'gender', 'birthday','followers_count','media_count'
        ])->scopes([
            'instagram_basic','instagram_manage_insights','manage_pages','pages_show_list','user_birthday','email'
        ])->redirect();
    }
    public function handleProviderFacebookCallback(request $request)
    {
         $user = Socialite::driver('facebook')->stateless()->user();
         $role=session('role');
         //get access token
         $accessToken=$user->token;
         // register user if new
         $existingUser = User::where('email', $user->getEmail())->first();
         if ($existingUser) {
             auth()->login($existingUser, true);
             if ($existingUser->role=='Influencer' && isset($existingUser->instagram_id)){
                 $this->updateInstagramData($accessToken,$existingUser);
             }
             return redirect()->route('influencers.index');
 
         } else {
             if(!empty($role)){
             $newUser                    = new User;
             $newUser->provider_name     = 'facebook';
             $newUser->provider_id       = $user->getId();
             $newUser->name              = $user->getName();
             $newUser->email             = $user->getEmail();
             $newUser->email_verified_at = now();
             $newUser->facebook_avatar            = $user->getAvatar();
             $newUser->facebook_token    =$user->token;
             $newUser->role= $role;
             $newUser->save();
             auth()->login($newUser, true);
             $newUser->assignRole($newUser->role);  //assign role
             if($role=='Influencer') $this->checkInstagramExists($accessToken,$newUser);
             return redirect(redirectTo());
             }
             else
       return view('auth.login',['msg'=> 'You are not registered.']);
            }   

         //  dd($user_id);
        //  $response = $client->request('GET', "https://graph.facebook.com/v5.0/17841401452952867?fields=biography%2Cid%2Cusername%2Cfollowers_count%2Cmedia_count%2Cfollows_count%2Cprofile_picture_url&access_token={$accessToken}");
        // $fb=new Facebook(config('facebook.config'));
        // $fb->setDefaultAccessToken($user->token);
        // $fields = "friends,link,gender,email,name_format,locale,picture,timezone,updated_time,verified";
        // $response = $client->request('GET', "https://graph.facebook.com/v5.0/17841401452952867/insights?metric=audience_country,audience_gender_age,audience_city&period=lifetime&access_token={$accessToken}");
        // $content = $response->getBody()->getContents();
        // $oAuth = json_decode($content); 
        // dd($oAuth->data);
        // $fb_user = $fb->get('/17841401452952867?fields=followers_count');
        // dd($fb_user);       
 
    }
public function checkInstagramExists($accessToken,$user)
{
        //Get instagram business account id and info (if the user has one)
        $client = new Client();
        $response1 = $client->request('GET', "https://graph.facebook.com/v3.0/me/accounts?fields=name,id,access_token,instagram_business_account{id,username,profile_picture_url,biography,ig_id,followers_count,follows_count,media_count,name,media{id,media_url}}&access_token={$accessToken}");
        $content1 = $response1->getBody()->getContents();
        $oAuth1 = json_decode($content1); 
        foreach($oAuth1->data as $page)   //Loop over pages to check if a page has business instagram account
        {
           if (isset($page->instagram_business_account))
           $account=$page->instagram_business_account;
        }
        //If instagram account exists store its data in instagram accounts table and instagram media table
        if(isset($account))            
        {
            $user->instagram_id=$account->id;
            $user->instagram_avatar=$account->profile_picture_url;
            $user->followers=$account->followers_count;
            $user->save();
             $this->handleInstagramAccount($account);
             $this->handleInstagramMedia($account);
             $this->handleInstagramInsights($account,$accessToken);

        }
}


 function handleInstagramAccount($account){
    $newAccount= new InstagramAccount;
    $newAccount->instagram_id=$account->id;
    $newAccount->influencer_id=Auth::user()->id;
    $newAccount->biography=isset($account->biography)?$account->biography:null;
    $newAccount->ig_id=isset($account->ig_id)?$account->ig_id:null;
    $newAccount->followers_count=isset($account->followers_count)?$account->followers_count:null;
    $newAccount->follows_count=isset($account->follows_count)?$account->follows_count:null;
    $newAccount->media_count=isset($account->media_count)?$account->media_count:null;
    $newAccount->name=isset($account->name)?$account->name:null;
    $newAccount->username=isset($account->username)?$account->username:null;
    $newAccount->profile_picture_url=isset($account->profile_picture_url)?$account->profile_picture_url:null;
    $newAccount->website=isset($account->website)?$account->website:null;
    $newAccount->save();
}

 function handleInstagramMedia($account){       //store account media in instagram media table
  $i = 0;
  foreach($account->media->data as $media_item)
  {
     $newMedia= new InstagramMedia;
     $newMedia->user_id=Auth::user()->id;
     $newMedia->instagram_id=$account->id;
     $newMedia->media_id=$media_item->id;
     $newMedia->media_url=$media_item->media_url;
     $newMedia->save();
     if(++$i == 40) break;

  }
}

 function handleInstagramInsights($account,$accessToken){     //get and store insights 
  $account_id=$account->id;
  $influencer_id=Auth::user()->id;
  $timestamp2=now()->timestamp;
  $timestamp1 = strtotime('-7 days', $timestamp2);
  $client = new Client();
  $response3 = $client->request('GET', "https://graph.facebook.com/v5.0/{$account_id}/insights?metric=audience_country,audience_gender_age&period=lifetime&access_token={$accessToken}");
  $response4 = $client->request('GET', "https://graph.facebook.com/v5.0/{$account_id}/insights?metric=profile_views&period=day&since={$timestamp1}&until={$timestamp2}&access_token={$accessToken}");
  $response5 = $client->request('GET', "https://graph.facebook.com/v5.0/{$account_id}/insights?metric=impressions,reach&period=day&since={$timestamp1}&until={$timestamp2}&access_token={$accessToken}");
  $content3 = json_decode($response3->getBody()->getContents()); //audience_country,audience_gender_age
  $content4 = json_decode($response4->getBody()->getContents()); //profile_views
  $content5 = json_decode($response5->getBody()->getContents()); //impressions,reach
#Location
  foreach($content3->data[0]->values[0]->value as $country => $count){
  DB::insert('insert into audience_location (country, count,influencer_id) values (?, ?, ?)', [$country, $count,Auth::user()->id]);
  }
#Gender
  $male=0; $female=0;
  foreach($content3->data[1]->values[0]->value as $key => $value){
    if(substr( $key, 0, 1 ) === 'M') $male=$male+$value;
    else if (substr( $key, 0, 1 ) === 'F') $female=$female+$value;
  }
  DB::insert('insert into audience_gender (male, female,influencer_id) values (?, ?, ?)', [$male, $female,Auth::user()->id]);
  #Age  
$more_than_65=0;
$between_55_and_65=0;
$between_45_and_55=0;
$between_35_and_45=0;
$between_25_and_35=0;
$between_18_and_25=0;
$between_13_and_18=0;
$less_than_13=0;
foreach($content3->data[1]->values[0]->value as $key => $value){
    if(substr( $key, -1 ) === '+') $more_than_65=$more_than_65+$value;
    else if (substr( $key, -1 ) === '-') $less_than_13=$less_than_13+$value;
    else if (substr( $key, -2 ) <= 18) $between_13_and_18=$between_13_and_18+$value;
    else if (substr( $key, -2 ) <= 25) $between_18_and_25=$between_18_and_25+$value;
    else if (substr( $key, -2 ) <= 35) $between_25_and_35=$between_25_and_35+$value;
    else if (substr( $key, -2 ) <= 45) $between_35_and_45=$between_35_and_45+$value;
    else if (substr( $key, -2 ) <= 55) $between_45_and_55=$between_45_and_55+$value;
    else $between_55_and_65=$between_55_and_65+$value;
  }

  DB::insert('insert into audience_age (more_than_65,between_55_and_65,between_45_and_55,between_35_and_45,between_25_and_35,between_18_and_25,between_13_and_18,
  less_than_13,influencer_id) values (?, ?, ?,?,?,?,?,?,?)', [ $more_than_65,$between_55_and_65,$between_45_and_55,$between_35_and_45,$between_25_and_35,$between_18_and_25,$between_13_and_18,$less_than_13,Auth::user()->id]);   
 #Insights over time (profile views, impressions, reach)
  for ($i = 0; $i <= 6; $i++) {
    $profile_views_item=$content4->data[0]->values[$i];
    $impressions_item=$content5->data[0]->values[$i];
    $reach_item=$content5->data[1]->values[$i];
    DB::insert('insert into instagram_insights (profile_views_value,profile_views_time,impressions_value, impressions_time,reach_value,reach_time,influencer_id,instagram_id) values (?, ?, ?,?,?,?,?,?)', [ $profile_views_item->value,$profile_views_item->end_time,$impressions_item->value,$impressions_item->end_time,$reach_item->value,$reach_item->end_time,Auth::user()->id,$account->id]);
}

}

function updateInstagramData($accessToken,$existingUser){
$account=InstagramAccount::where('influencer_id', $existingUser->id)->delete();
$media=InstagramMedia::where('user_id',$existingUser->id)->delete();

DB::delete('delete from audience_age where influencer_id = ?', [$existingUser->id]);
DB::delete('delete from audience_gender where influencer_id = ?', [$existingUser->id]);
DB::delete('delete from audience_location where influencer_id = ?', [$existingUser->id]);
DB::delete('delete from instagram_insights where influencer_id = ?', [$existingUser->id]);

$this->checkInstagramExists($accessToken,$existingUser);
}


use AuthenticatesUsers;

/**
 * Create a new controller instance.
 *
 * @return void
 */
public function __construct()
{
    $this->middleware('guest')->except('logout');
}

}
