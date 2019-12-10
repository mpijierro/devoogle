<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhpBarcelonaYoutube extends Migration
{
    public function up()
    {
        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => 'UCBqwZ_Nvu9gSyB3VP4p1wcA',
            'slug_name'       => 'php-barcelona-ii',
            'name'            => 'PHP Barcelona (II)',
            'is_user_channel' => false,

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
