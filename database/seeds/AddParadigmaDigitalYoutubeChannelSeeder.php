<?php

use Illuminate\Database\Seeder;

class AddParadigmaDigitalYoutubeChannelSeeder extends Seeder
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
            'slug_id'         => 'ParadigmaTe',
            'slug_name'       => 'paradigma-digital',
            'name'            => 'Paradigma Digital',
            'is_user_channel' => true,
            'created_at'      => \Carbon\Carbon::now(),
            'updated_at'      => \Carbon\Carbon::now(),
        ]);
    }
}
