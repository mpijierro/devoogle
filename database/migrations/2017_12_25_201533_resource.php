<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Resource extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource', function (Blueprint $table) {

            $table->increments('id');

            $table->uuid('uuid');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('source_id')->unsigned();
            $table->foreign('source_id')->references('id')->on('source');

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('category');

            $table->integer('lang_id')->unsigned();
            $table->foreign('lang_id')->references('id')->on('lang');

            $table->string('title');
            $table->text('description');
            $table->string('url');
            $table->string('slug');
            $table->datetime('published_at');
            $table->boolean('reviewed')->default(false);

            $table->timestamps();
            $table->softDeletes();

            $table->index('url');
            $table->index('slug');
            $table->index('published_at');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resource');
    }
}
