<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddYoutubeVideo extends Migration
{
    public function up()
    {
        Schema::create('youtube_video', function (Blueprint $table) {

            $table->increments('id');
            $table->text('info');
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
        Schema::dropIfExists('youtube_video');
    }
}
