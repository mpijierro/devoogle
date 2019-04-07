<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChannelDeCharlas extends Migration
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
            'slug_id'         => 'decharlastv',
            'slug_name'       => 'decharlastv',
            'name'            => 'Decharlas Castellón',
            'is_user_channel' => true,

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
