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
            'slug'                => \Devoogle\Src\SourceReader\Library\ApiProcessor\Youtube\Processor::SLUG,
            'last_time_processed' => null,
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now()
        ]);

        DB::table('source')->insert([
            'type_source_id' => 2,
            'name'           => 'WeDevelopers',
            'slug'           => \Devoogle\Src\SourceReader\Library\RssProcessor\WeDevelopers\Processor::SLUG,
            'created_at'     => \Carbon\Carbon::now(),
            'updated_at'     => \Carbon\Carbon::now()
        ]);

        DB::table('source')->insert([
            'type_source_id' => 2,
            'name'           => 'Entre Dev y Ops',
            'slug'           => Devoogle\Src\SourceReader\Library\RssProcessor\EntreDevOps\Processor::SLUG,
            'created_at'     => \Carbon\Carbon::now(),
            'updated_at'     => \Carbon\Carbon::now()
        ]);

    }
}
