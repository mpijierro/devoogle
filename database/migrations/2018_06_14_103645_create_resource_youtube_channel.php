<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceYoutubeChannel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_youtube_channel', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('resource_id')->unsigned();
            $table->foreign('resource_id')->references('id')->on('resource');

            $table->integer('youtube_channel_id')->unsigned();
            $table->foreign('youtube_channel_id')->references('id')->on('youtube_channel');

            $table->index('resource_id');
            $table->index('youtube_channel_id');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('later');
    }
}
