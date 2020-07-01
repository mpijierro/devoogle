<?php

use Illuminate\Database\Migrations\Migration;

class AddGoogleStartusYoutube extends Migration
{

    public function up()
    {
        DB::table('youtube_channel')->insert([
             'source_id'       => 1,
             'slug_id'         => 'UCkWLGZL69LhjjgGRKhcAE_w',
             'slug_name'       => 'google-for-startups',
             'name'            => 'Google for Startups',
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
