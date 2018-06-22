<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastTimeProcessedToYoutubeChannel extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('youtube_channel', function (Blueprint $table) {
            $table->datetime('last_time_processed')->nullable()->after('is_user_channel');
        });

        $query = DB::table('youtube_channel')->update(['last_time_processed' => \Carbon\Carbon::now()]);

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
