<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('provider_name')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('role')->nullable();
            $table->string('facebook_token')->nullable();
            $table->longText('avatar')->nullable();
            $table->longText('facebook_avatar')->nullable();
            $table->longText('instagram_avatar')->nullable();
            $table->longText('youtube_avatar')->nullable();
            $table->string('instagram_id')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->integer('country_id')->references('id')->on('countries')->nullable();
            $table->integer('category_id')->references('id')->on('categories')->nullable();
            $table->boolean('verified')->nullable();
            $table->integer('youtube_followers')->nullable();
            $table->integer('instagram_followers')->nullable();
            $table->integer('followers')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('twitter_id')->nullable();





        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
