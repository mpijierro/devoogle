<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('is_user_channel');

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
