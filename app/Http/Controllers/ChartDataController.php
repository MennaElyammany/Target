<?php

namespace App\Http\Controllers;
use Carbon;
use DB;
use Illuminate\Http\Request;
use View;
use Alaouy\Youtube\Facades\Youtube;

class ChartDataController extends Controller
{
   
    function chart(request $request, $id){
        $subscribers = getSubscribers($id);
        dd($subscribers);
        $result =calcEngagement($request->data);
        return View::make('influencers.chart', ['id' => $id,'result'=>$result]);
    }
}
