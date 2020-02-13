<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTwitterAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('twitter_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('twitter_id')->references('twitter_id')->on('users');
            $table->unsignedInteger('influencer_id')->references('id')->on('users');
            $table->longText('description')->nullable();
            $table->string('nickname')->nullable();
            $table->integer('statuses_count')->nullable();
            $table->integer('friends_count')->nullable();
            $table->string('location')->nullable();
            $table->string('expanded_url')->nullable();
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
        Schema::dropIfExists('twitter_accounts');
    }
}
