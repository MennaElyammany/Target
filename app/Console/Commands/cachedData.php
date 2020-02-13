<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\carbon;



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
       try{
        $users= DB::table('users')->where('role', 'Influencer'); //returns collection

        $users=$users->get();
        foreach($users as $user){
            if( Redis::ttl($user->id)<=0){
                DB::table('users')
                ->where('id', $user->id)
                ->update(['updated_at' => now()]);
             $data=fetch_youtube_data($user->youtube_url);
             
             Redis::setex($user->id,60*60*48, json_encode($data));
    }
           
            }
echo('done');
         
        }
         catch (\Exception $e) {
          
            echo($e->getMessage());
          }

           
        }
    }

