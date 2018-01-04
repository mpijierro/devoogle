<?php

use Illuminate\Database\Seeder;

class VideoChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('video_channel')->insert([
            'platform_id' => 1,
            'slug_id' => 'UCvZ6HKYcDtqtK1SfbIpB97g',
            'slug_name' => 'AutentiaMedia',
            'name' => 'AutentiaMedia'
        ]);
    }
}
