<?php

namespace App\Http\Controllers;
use Carbon;
use DB;
use Illuminate\Http\Request;
use View;
use Alaouy\Youtube\Facades\Youtube;

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
    function chart(request $request, $id){
        $result =calcEngagement($request->data);
        return View::make('influencers.chart', ['id' => $id,'result'=>$result]);
    }
}
