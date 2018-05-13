<?php

use Illuminate\Database\Seeder;

class SourceSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('source')->insert([
            'type_source_id'      => 1,
            'name'                => 'Youtube',
            'slug'                => 'youtube',
            'last_time_processed' => null,
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now()
        ]);

        DB::table('source')->insert([
            'type_source_id' => 2,
            'name'           => 'WeDevelopers',
            'slug'           => 'wedevelopers',
            'created_at'     => \Carbon\Carbon::now(),
            'updated_at'     => \Carbon\Carbon::now()
        ]);

    }
}
