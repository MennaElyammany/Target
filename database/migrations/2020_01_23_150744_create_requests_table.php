<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            // $table->enum('status',['waiting','accepted','declined','modifiedByClient','modifiedByInf','completed']);
            $table->enum('type',['image','video','story']);
            $table->text('description');
            $table->date('ad_date');
            $table->string('company_name')->nullable();
            $table->string('website_url')->nullable();
            $table->string('product_image')->nullable();
            $table->unsignedInteger('client_id')->references('id')->on('users');
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
        Schema::dropIfExists('requests');
    }
}
