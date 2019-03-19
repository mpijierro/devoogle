<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCanariasJsYoutubeChannel extends Migration
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
            'slug_id'         => 'UCyAtZpBeHj10miF0wBDlfqA',
            'slug_name'       => 'canarias-js',
            'name'            => 'Canarias JS',
            'is_user_channel' => false,

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => 'UCDGdkl6pK_GsOof3c_mDWbg',
            'slug_name'       => 'extremadura-digital-day',
            'name'            => 'Extremadura Digital Day',
            'is_user_channel' => false,

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => 'UCea-uCoYFkBD_Mmt9ZXoxUw',
            'slug_name'       => 'programalo-tu',
            'name'            => 'PrográmaloTú',
            'is_user_channel' => false,

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => 'UCbxo-ETjlDOoxl-_I6jZA6g',
            'slug_name'       => 'apiumhub',
            'name'            => 'Apiumhub',
            'is_user_channel' => false,

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => 'UCp9sbFqQ6w7YGnAULjoYVdQ',
            'slug_name'       => 'wordcamp-madrid',
            'name'            => 'WordCamp Madrid',
            'is_user_channel' => false,

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => 'UC3KyKpIyhLAnIUqcYBo4PFg',
            'slug_name'       => 'j-on-the-beach',
            'name'            => 'J On The Beach',
            'is_user_channel' => false,

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => 'UCVLlWT1NZZEJs4A67XgObnQ',
            'slug_name'       => 'js-camp',
            'name'            => 'JSCamp',
            'is_user_channel' => false,

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => 'UCyth_6hqft9a7B_thdwYyww',
            'slug_name'       => 'python-espana',
            'name'            => 'Python España',
            'is_user_channel' => false,

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => 'UCEBcDOjv-bhAmLavY71RMHA',
            'slug_name'       => 'lambda-world',
            'name'            => 'Lambda World',
            'is_user_channel' => false,

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => 'strsistemas',
            'slug_name'       => 'strsistemas',
            'name'            => 'STRSistemas',
            'is_user_channel' => true,

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => 'TheGreachChannel',
            'slug_name'       => 'the-greach-channel',
            'name'            => 'The Greach Channel',
            'is_user_channel' => true,

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => 'BigDataSpain',
            'slug_name'       => 'big-data-spain',
            'name'            => 'Big Data Spain',
            'is_user_channel' => true,

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => 'CodemotionWorld',
            'slug_name'       => 'codemotion-world',
            'name'            => 'Codemotion World',
            'is_user_channel' => true,

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
