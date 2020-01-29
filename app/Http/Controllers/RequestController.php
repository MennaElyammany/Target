<?php

namespace App\Http\Controllers;

use Auth;
use App\Request;
use Notification;
use App\Notifications\RequestChanged;
use App\User;
use Illuminate\Support\Facades\Redirect;
class RequestController extends Controller
{
    function show(){
    
        $requests=Auth::user()->requests;
      
        return view('requests.show',['requests'=>$requests]);
    }
    function accept($id){
       
        $request= Request::findOrFail($id);
        if(Auth::user()->id==$request->client_id)
        $notified_user=$request->influencer_id;
        else
        $notified_user=$request->client_id;
        $request->status='accepted';
        $request->save();
        $this->sendNotification('accepted',$notified_user);
        return back();


    }
    function decline($id){
       
        $request= Request::findOrFail($id);
        if(Auth::user()->id==$request->client_id)
            $notified_user=$request->influencer_id;
            else
            $notified_user=$request->client_id;
        $request->status='declined';
        $request->save();
        $this->sendNotification('declined',$notified_user);

        return back();


    }
    function sendNotification($status,$id){
        
        $user= User::findOrFail($id);
        $details=[
            'body'=>'Your Request status is '.$status,
           'status'=>$status,

        ];
        $user->notify( new RequestChanged($details));
        

    }
    function read(){
        
      Auth::User()->unreadNotifications()->update(['read_at' => now()]);
        
    }
    function checkout(){
        return view('requests.checkout');
    }
    function charge(Request $request){
        dd($request->stripeToken);
    }
}
