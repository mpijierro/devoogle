<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJoelOnSoftwareBlog extends Migration
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
            'name' => 'Joel On Software',
            'url' => 'https://www.joelonsoftware.com/',
            'slug' => Devoogle\Src\SourceReader\Library\RssProcessor\JoelOnSoftware\Processor::SLUG,
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
