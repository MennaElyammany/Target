<?php

namespace App\Http\Controllers;
use Carbon;
use DB;
use Illuminate\Http\Request;
use View;
use Alaouy\Youtube\Facades\Youtube;
use App\User;

class ChartDataController extends Controller
{
    function getMonths($id){
        $dates= DB::table('subscribers_time')->where('influencer_id',$id)->pluck('time');
        $dates=json_decode($dates);
        if ( ! empty( $dates) ) {
            foreach ( $dates as $date ) {
                $date = Carbon\Carbon::parse($date);
                $month_no = $date->format( 'm' );
                $month_name = $date->format( 'M' );
                $month_array[ $month_no ] = $month_name;
            }
        }
        return $month_array;
    
    }
    function getDays($id){
        $dates= DB::table('instagram_insights')->where('influencer_id',$id)->pluck('follower_count_time');
        $dates=json_decode($dates);
        if ( ! empty( $dates) ) {
            foreach ( $dates as $date ) {
                $date = Carbon\Carbon::parse($date);
                $day_no = $date->format( 'd' );
                $day_name = $date->format( 'D' );
                $day_array[ $day_no ] = $day_name;
            }
        }
        return $day_array;
    
    }
    
    function getSubscribers($id){       
        $subscribers_count= DB::table('subscribers_time')->where('influencer_id',$id)->pluck('subscribers_count');
       $subscribers_count_array=array();
    
        foreach($subscribers_count as $count){
          array_push($subscribers_count_array, $count);
        }
         $max_no = max($subscribers_count_array);
         $max = round(( $max_no + 10/5 ) / 10 ) * 10;
         $months= $this->getMonths($id);
         $month_name_array=array();
         if ( ! empty( $months ) ) {
          foreach ( $months as $month_no => $month_name ){
              array_push( $month_name_array, $month_name );
          }
      }
         $subscribers_per_month=array(
             'id'=>$id,
             'months'=> $month_name_array,
             'subscribers'=>$subscribers_count_array,
             'max'=>$max
         );
         return $subscribers_per_month;
         
      }

    function getFollowers($id){
            $followers_count= DB::table('instagram_insights')->where('influencer_id',$id)->pluck('follower_count_value');
           $followers_count_array=array();
        
            foreach($followers_count as $count){
              array_push($followers_count_array, $count);
            }
             $max_no = max($followers_count_array);
             $max = round(( $max_no + 10/5 ) / 10 ) * 10;
             $days= $this->getDays($id);
             $day_name_array=array();
             if ( ! empty( $days ) ) {
              foreach ( $days as $day_no => $day_name ){
                  array_push( $day_name_array, $day_name );
              }
          }
             $followers_per_day=array(
                 'id'=>$id,
                 'days'=> $day_name_array,
                 'followers'=>$followers_count_array,
                 'max'=>$max
             );
            return $followers_per_day;
             
          }
    
    function getAudienceGender($id){
        $audience= DB::table('audience_gender')->where('influencer_id',$id)->get();
        $gender_array=array();
        $gender_count_array=array();
        array_push($gender_array,'male','female');
        array_push($gender_count_array,$audience[0]->male,$audience[0]->female);
        $audience_gender=array(
            'id'=>$id,
            'gender'=>$gender_array,
            'gender_count'=>$gender_count_array
        );
        return $audience_gender;


    } 
    function getAudienceLocation($id){
        $countries=DB::table('audience_location')->where('influencer_id',$id)->pluck('country');
        $count=DB::table('audience_location')->where('influencer_id',$id)->pluck('count');
        $audience_location = array(
            'countries'=> $countries,
            'count'=>$count
            
        );
        return $audience_location;


    }
    function getAudienceAge($id){
        $ages= DB::table('audience_age')->where('influencer_id',$id)->get();
        $ages_array=array();
        array_push($ages_array,'<13','13-18','18-25','25-35','35-45');
        $ages_count_array=array();
        array_push($ages_count_array,$ages[0]->less_than_13,$ages[0]->between_13_and_18,$ages[0]->between_18_and_25,$ages[0]->between_25_and_35,$ages[0]);
        return $audience_age=array(
            'ages'=>$ages_array,
            'count'=>$ages_count_array
        );


    }
 
    function chart(request $request, $id){
        $result =calcEngagement($request->data);
        return View::make('influencers.chart', ['id' => $id,'result'=>$result]);
    }
    function InstagramChart(request $request, $id){
        $result =calcInstagramEngagement($id);
        return View::make('influencers.instagramChart',['id'=> $id, 'result'=>$result]);

    }
}
