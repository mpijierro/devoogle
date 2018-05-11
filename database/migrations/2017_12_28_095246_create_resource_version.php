<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourceVersion extends Migration
{
    public function up()
    {
        Schema::create('resource_version', function (Blueprint $table) {

            $table->increments('id');

            $table->uuid('uuid');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('resource_id')->unsigned()->nullable();
            $table->foreign('resource_id')->references('id')->on('resource');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('category');

            $table->string('url');
            $table->text('comment');
            $table->boolean('reviewed')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->index('url');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resource_version');
    }
}
