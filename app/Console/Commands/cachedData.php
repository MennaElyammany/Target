<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use App\User;


class cachedData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cached:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'update user data in cache';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::where([
            ['role','=','Influencer'],
            ['youtube_url','!=',NULL]

        ]);
        foreach($users as $user){
            if( Redis::ttl($user->id)<=0){
            $data=fetch_youtube_data($user->youtube_url);
            Redis::setex($user->id,60*60*48, json_encode($data));

            }
        }
    }
}
