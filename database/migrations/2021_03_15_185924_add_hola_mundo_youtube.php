<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHolaMundoYoutube extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('youtube_channel')->insert([
             'source_id'       => 1,
             'slug_id'         => 'UC4FHiPgS1KXkUMx3dxBUtPg',
             'slug_name'       => 'hola-mundo',
             'name'            => 'HolaMundo',
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
