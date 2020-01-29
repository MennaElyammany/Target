<?php

namespace App\Http\Controllers;

use Auth;
use App\Request;
use Notification;
use App\Notifications\RequestChanged;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreAdrequestRequest;

class RequestController extends Controller
{
    function show(){
    
        $requests=Auth::user()->Requests;
      
        return view('requests.show',['requests'=>$requests]);
    }
    function create(){
      
        return view('requests.create',['influencer_id'=>request()->input('influencer_id')]);
    }

    function store(StoreAdrequestRequest $request){
        $influencer_id=request()->input('influencer_id');
    $newrequest =Request::create([
     'company_name'=>$request->company_name,
     'type'=>$request->type,
     'website_url'=>$request->website_url,
     'description'=>$request->description,
     'ad_date'=>$request->ad_date,
     'client_id'=>Auth::user()->id,
     'influencer_id'=>$influencer_id,

    ]);
    if($request->product_image){
        $newrequest->update(['product_image'=>$request->file('product_image')->storeAs('product_images',$request->company_name)]);
       
        }
        $influencer=User::findOrFail($influencer_id);
        Auth::user()->Requests()->sync($newrequest);
        $influencer->Requests()->sync($newrequest);
        $this->notifyNewRequest($influencer_id);
        return redirect()->route('requests.show');

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
    function notifyNewRequest($id){
        $user= User::findOrFail($id);
        $details=[
            'body'=>'You have a new ad request',
           'status'=>$status,

        ];
        $user->notify( new RequestChanged($details));
        

    }
    function read(){
        
      Auth::User()->unreadNotifications()->update(['read_at' => now()]);
        
    }

    
}
