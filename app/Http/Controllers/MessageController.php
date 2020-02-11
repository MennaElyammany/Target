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
    function index(Request $request){
        $msgs = Message::where('reciever_id',$request->influencer)->orderBy('created_at','desc')->get();
        $recievers = [];
        $conversations = [];        
        foreach($msgs as $msg){
            if(!in_array($msg['sender_id'], $recievers)){
             array_push($recievers,$msg['sender_id']);
             $reciever = User::findOrFail($msg['sender_id']);
             $conversation = array(
                "content" => $msg->content,
                "reciever_name" => $reciever->name,
                "reciever_avatar" => $reciever->avatar,
                "reciever_id" => $reciever->id
             );
             array_push($conversations,$conversation);   
            }
            
        }
        // dd($conversations);
        return view('messages.index',compact('conversations'));
    }
    function displayConversation($id){
        $loggedIn = Auth::user();
        $msgsFromSender = Message::where('sender_id','=',$loggedIn->id)->where('reciever_id','=',$id)->get();
        $msgsFromReciever = Message::where('reciever_id','=',$loggedIn->id)->where('sender_id','=',$id)->get();
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
        return $messages;
    }
    function storeInfluencer($id,$auth,$msg){
        $message = Message::create(['content' => $msg,'sender_id'=>$auth,'reciever_id'=>$id]);
        return $message;
    }
}
