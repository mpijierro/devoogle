<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJummpBlog extends Migration
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
            'name' => 'Jummp',
            'url' => 'https://jummp.wordpress.com/',
            'slug' => Devoogle\Src\SourceReader\Library\RssProcessor\Jummp\Processor::SLUG,
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
