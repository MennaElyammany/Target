<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstagramAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instagram_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('instagram_id')->references('instagram_id')->on('users');
            $table->unsignedInteger('influencer_id')->references('id')->on('users');
            $table->longText('biography')->nullable();
            $table->string('ig_id')->nullable();
            $table->integer('followers_count')->nullable();
            $table->integer('follows_count')->nullable();
            $table->integer('media_count')->nullable();
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->longText('profile_picture_url')->nullable();
            $table->longText('website')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('instagram_accounts');
    }
}
