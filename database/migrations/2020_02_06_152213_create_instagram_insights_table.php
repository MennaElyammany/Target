<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstagramInsightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instagram_insights', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('influencer_id')->references('id')->on('users');
            $table->string('instagram_id')->references('instagram_id')->on('users');
            $table->integer('impressions_value');
            $table->string('impressions_time')->nullable();
            $table->integer('reach_value');
            $table->string('reach_time')->nullable();
            $table->integer('profile_views_value');
            $table->string('profile_views_time')->nullable();
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
        Schema::dropIfExists('instagram_insights');
    }
}
