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
            $table->string('between_35_and_45');
            $table->string('between_45_and_55');
            $table->string('between_55_and_65');
            $table->string('more_than_65');           
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
