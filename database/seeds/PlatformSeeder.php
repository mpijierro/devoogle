<?php

use Illuminate\Database\Seeder;

class PlatformSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('platform')->insert([
            'key' => 'youtube',
            'name' => 'Youtube',
        ]);
    }
}
