<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDownloadCounter extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_counter', function (Blueprint $table) {

            $table->increments('id');

            $table->integer('resource_id')->unsigned();
            //$table->foreign('resource_id')->references('id')->on('resource');

            $table->timestamps();

            $table->index('resource_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('download_counter');
    }
}
