<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGallegoChannel extends Migration
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
            'slug_id'         => 'micaelgallego',
            'slug_name'       => 'micaelgallego',
            'name'            => 'Micael Gallego',
            'is_user_channel' => true,

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => 'UCJDkEoAAZclorR4jEF9Kv3Q',
            'slug_name'       => 'sngular',
            'name'            => 'Sngular',
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
