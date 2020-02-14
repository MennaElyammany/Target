<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramAccount extends Model
{
    protected $table = 'instagram_accounts';
    protected $fillable = [
       'influencer_id','instagram_id','biography','ig_id','followers_count','follows_count','media_count','name','profile_picture_url','username','website'
    ];

}
