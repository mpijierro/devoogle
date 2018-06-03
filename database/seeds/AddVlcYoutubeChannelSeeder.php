<?php

use Illuminate\Database\Seeder;

class AddVlcYoutubeChannelSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => 'UCS7z_DqAOTqwANFvmKmM5ig',
            'slug_name'       => 'vlc-techfest',
            'name'            => 'VLC TechFest',
            'is_user_channel' => false,
            'created_at'      => \Carbon\Carbon::now(),
            'updated_at'      => \Carbon\Carbon::now(),
        ]);
    }
}
