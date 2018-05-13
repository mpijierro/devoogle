<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddResourceRaw extends Migration
{
    public function up()
    {
        Schema::create('resource_raw', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('resource_id')->unsigned();
            $table->foreign('resource_id')->references('id')->on('resource');
            
            $table->json('info');
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
        Schema::dropIfExists('resource_raw');
    }
}
