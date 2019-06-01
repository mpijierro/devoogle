<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDanielPrimoFeed extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('source')->insert([
            'type_source_id' => 2,
            'name' => 'Daniel Primo',
            'url' => 'https://www.danielprimo.io/',
            'slug' => Devoogle\Src\SourceReader\Library\RssProcessor\DanielPrimo\Processor::SLUG,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
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
