<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGarajeando extends Migration
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
            'name' => 'Garajeando',
            'url' => 'http://garajeando.blogspot.com/',
            'slug' => Devoogle\Src\SourceReader\Library\RssProcessor\Garajeando\Processor::SLUG,
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
