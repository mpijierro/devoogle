<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLiferayAgoraYoutubeChannel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => 'UCNx2OKqFypdjCSbu-42UElw',
            'slug_name'       => 'liferay-agora',
            'name'            => 'Liferay Ágora',
            'is_user_channel' => false,

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
