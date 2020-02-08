<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use Auth;

class MessageController extends Controller
{
    function create(Request $request){
        $loggedIn = Auth::user();
        $msgsFromSender = Message::where('sender_id','=',$loggedIn->id)->where('reciever_id','=',$request->influencer)->get();
        $msgsFromReciever = Message::where('reciever_id','=',$loggedIn->id)->where('sender_id','=',$request->influencer)->get();
        $messages = [];
        if($msgsFromSender || $msgsFromSender){
            foreach($msgsFromSender as $msgSender){
                array_push($messages,$msgSender);
            }
            foreach($msgsFromReciever as $msgReciever){
                array_push($messages,$msgReciever);
            } 
        }
        array_multisort( array_column($messages, "created_at"), SORT_ASC,$messages);
        $reciever = $request->influencer;
        $sender = Auth::user();
        return view('messages.create',['sender'=>$sender->id,'reciever'=>$reciever,'messages'=>$messages]);
    }
    
    function store(Request $request){
        $message = Message::create(['content' => $request->content,'sender_id'=>$request->senderId,'reciever_id'=>$request->influencer]);
        return $this->create($request);
    }
    //users chat
    function show(Request $request){
        
    }

}
