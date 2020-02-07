<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAudienceAgeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audience_age', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('less_than_13');
            $table->string('between_13_and_18');
            $table->string('between_18_and_25');
            $table->string('between_25_and_35');
            $table->string('between_35_and_40');
            $table->unsignedInteger('influencer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audience_age');
    }
}
