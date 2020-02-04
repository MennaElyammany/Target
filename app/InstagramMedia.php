<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstagramMedia extends Model
{
    protected $table = 'instagram_media';
    protected $fillable = [
        'user_id', 'instagram_id', 'media_id','media_url'
    ];

}
