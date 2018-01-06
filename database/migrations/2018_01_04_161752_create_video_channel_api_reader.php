<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoChannelApiReader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_channel', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('platform_id')->unsigned();
            $table->foreign('platform_id')->references('id')->on('platform');

            $table->string('slug_id');
            $table->string('slug_name');
            $table->string('name');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('video_channel');
    }
}
