<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYoutubeChannelApiReader extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('youtube_channel', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('source_id')->unsigned();
            $table->foreign('source_id')->references('id')->on('source');

            $table->string('slug_id');
            $table->string('slug_name');
            $table->string('name');

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
        Schema::dropIfExists('youtube_channel');
    }
}
