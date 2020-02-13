<?php

namespace App\Http\Controllers;

use Auth;
use App\Request;
use Notification;
use App\Notifications\RequestChanged;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreAdrequestRequest;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\StoreRatingRequest;
use App\Rating;

class RequestController extends Controller
{
    function index(){
     
        if(Auth::user()->hasRole('Admin'))
        $requests=Request::all();
        else
         $requests=Auth::user()->Requests;
       
      
        return view('requests.index',['requests'=>$requests]);
    }
    function show($id){
        $request= Request::findOrFail($id);
        return view('requests.show',['request'=>$request]);
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
         $newrequest->update(['product_image'=>$request->file('product_image')->store('product_images','public')]);
            }
            
        
        $influencer=User::findOrFail($influencer_id);
        Auth::user()->Requests()->attach($newrequest);
        $influencer->Requests()->attach($newrequest);
        $this->notifyNewRequest($influencer_id);
        return redirect()->route('requests.index');

    }
    function requestModified($id){
        $request= Request::findOrFail($id);
        if(Auth::user()->id==$request->client_id){
            $notified_user=$request->influencer_id;
            $request->update(['modified_date'=>request()->ad_date]);
            if($request->status=="accepted")
            $request->update(['status'=>'paid']);
            else
            $request->update(['status'=>'modifiedByClient']);
            $this->notifyModifiedRequest($notified_user);

        }
        else{
           

            $notified_user=$request->client_id;
            if(request()->price!=$request->price)
            $request->update(['price'=>request()->price]);
            if(request()->ad_date!=$request->ad_date)
            $request->update(['modified_date'=>request()->ad_date]);
            $request->update(['status'=>'modifiedByInf']);

           $this->notifyModifiedRequest($notified_user);


        }

        


        return redirect()->route('requests.index');

    }
    function accept($id){
        $request= Request::findOrFail($id);
        if(Auth::user()->id==$request->client_id){
        $notified_user=$request->influencer_id;
        $influencer = User::findOrFail($request->influencer_id); 
        $data = array(
        'name' => $influencer->name,
        'message' => "the client has accepted the updated request"
        );
        Mail::to($influencer->email)->send(new SendEmail($data));
        }
        else{
        $notified_user=$request->client_id;
        $client = User::findOrFail($notified_user); 
        $data = array(
        'name' => $client->name,
        'message' => "the influencer has accepted the request"
        );
        Mail::to($client->email)->send(new SendEmail($data));
        }
        if($request->modified_date!=null)
        $request->ad_date=$request->modified_date;
        $request->modified_date=null;
        $request->status='accepted';
        $request->save();
        $this->sendNotification('accepted',$notified_user);
        return redirect()->route('requests.index');

    }
    function decline($id){
        $request= Request::findOrFail($id);
        if(Auth::user()->id==$request->client_id)
            $notified_user=$request->influencer_id;
            else
            $notified_user=$request->client_id;
        $user = User::findOrFail($notified_user); 
        $data = array(
            'name' => $user->name,
            'message' => "your request has been decline"
        );
        Mail::to($user->email)->send(new SendEmail($data));            
        $request->status='declined';
        $request->save();
        $this->sendNotification('declined',$notified_user);

        return back();


    }
    function completed($id){
       
        $request= Request::findOrFail($id);
     
         $notified_user=$request->client_id;
        $request->status='completed';
        $request->save();
        $this->sendNotification('completed',$notified_user);
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
          

        ];
        $user->notify( new RequestChanged($details));
        

    }
    function notifyModifiedRequest($id){
        $user= User::findOrFail($id);
        $details=[
            'body'=>'Your request is updated please check it ',
          

        ];
        $user->notify( new RequestChanged($details));
        

    }
    function read(){
        
      Auth::User()->unreadNotifications()->update(['read_at' => now()]);
        
    }
    function checkout($request){
        $this->requestModified($request);
        return view('requests.checkout');
    }
    function charge(Request $request){
        dd($request->stripeToken);
    }
    function storeRating(StoreRatingRequest $request){   
            $rateableUser = User::find($request->rateable_id);
            $rating = new Rating;
            $rating->rating = $request->rate;
            $rating->user_id = \Auth::id();
            $rating->rateable_id=$request->rateable_id;
            $rating->request_id=$request->request_id;
            $rating->review=$request->review;
            $rateableUser->ratings()->save($rating);
            return redirect()->route('requests.index');


    
    
    
    
    }
}

