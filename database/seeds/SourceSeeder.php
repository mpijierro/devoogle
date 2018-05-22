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
            'url'            => 'http://wedevelopers.com/',
            'slug'           => \Devoogle\Src\SourceReader\Library\RssProcessor\WeDevelopers\Processor::SLUG,
            'created_at'     => \Carbon\Carbon::now(),
            'updated_at'     => \Carbon\Carbon::now()
        ]);

        DB::table('source')->insert([
            'type_source_id' => 2,
            'name'           => 'Entre Dev y Ops',
            'url'            => 'http://www.entredevyops.es/',
            'slug'           => Devoogle\Src\SourceReader\Library\RssProcessor\EntreDevOps\Processor::SLUG,
            'created_at'     => \Carbon\Carbon::now(),
            'updated_at'     => \Carbon\Carbon::now()
        ]);

        DB::table('source')->insert([
            'type_source_id' => 2,
            'name'           => 'Basta ya de picar',
            'url'            => 'http://www.bastayadepicar.com/',
            'slug'           => Devoogle\Src\SourceReader\Library\RssProcessor\BastaYaDePicar\Processor::SLUG,
            'created_at'     => \Carbon\Carbon::now(),
            'updated_at'     => \Carbon\Carbon::now()
        ]);

        DB::table('source')->insert([
            'type_source_id' => 2,
            'name'           => 'Programar es una mierda',
            'url'            => 'http://www.programaresunamierda.com/',
            'slug'           => Devoogle\Src\SourceReader\Library\RssProcessor\ProgramarEsUnaMierda\Processor::SLUG,
            'created_at'     => \Carbon\Carbon::now(),
            'updated_at'     => \Carbon\Carbon::now()
        ]);

        DB::table('source')->insert([
            'type_source_id' => 2,
            'name'           => 'RantPod',
            'slug'           => Devoogle\Src\SourceReader\Library\RssProcessor\RantPod\Processor::SLUG,
            'created_at'     => \Carbon\Carbon::now(),
            'updated_at'     => \Carbon\Carbon::now()
        ]);

    }
}
