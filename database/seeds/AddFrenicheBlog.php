<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddFrenicheBlog extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('source')->insert([
            'type_source_id' => 2,
            'name' => 'Diego Freniche',
            'url' => 'http://blog.freniche.com/',
            'slug' => Devoogle\Src\SourceReader\Library\RssProcessor\Freniche\Processor::SLUG,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
