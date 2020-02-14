<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwitterPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twitter_posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedInteger('user_id')->references('id')->on('users');
            //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //$table->string('twitter_id')->references('twitter_id')->on('users'); 
            $table->string('tweet_id')->nullable();
            $table->longText('text')->nullable();
            $table->integer('favorite_count')->nullable(); 
            $table->integer('retweet_count')->nullable();
            //$table->string('in_reply_to_screen_name')->nullable();
            
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('twitter_posts');
    }
}
