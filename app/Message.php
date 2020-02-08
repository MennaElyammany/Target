<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['content','sender_id','reciever_id'];
    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
}
