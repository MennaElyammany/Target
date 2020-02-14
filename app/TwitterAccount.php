<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TwitterAccount extends Model
{
    protected $table = 'twitter_accounts';
    protected $fillable = ['twitter_id','influencer_id','description','nickname','statuses_count','friends_count','location','expanded_url'];
}