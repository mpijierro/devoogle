<?php

use Illuminate\Database\Seeder;

class YoutubeChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('youtube_channel')->insert([
            'source_id'           => 1,
            'slug_id'             => 'UCvZ6HKYcDtqtK1SfbIpB97g',
            'slug_name'           => 'autentia-media',
            'name'                => 'AutentiaMedia',

            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'           => 1,
            'slug_id'             => 'UC9IKtxn9AIGelnYmwYr0Lxw',
            'slug_name'           => 'codely-tv',
            'name'                => 'CodelyTv',

            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'           => 1,
            'slug_id'             => 'UCDUS9HwdxHp9DjI0nRDrR0A',
            'slug_name'           => 'beta-beers',
            'name'                => 'Beta beers',
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'           => 1,
            'slug_id'             => 'UCh79t1YY9nZVfawaV3xOZNQ',
            'slug_name'           => 'geekshub-academy',
            'name'                => 'GeeksHubs Academy',
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'           => 1,
            'slug_id'             => 'UCDJARuPiO4QX2o-rpEEGOXA',
            'slug_name'           => 'comunidad-code',
            'name'                => 'Comunidad CODE',
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'           => 1,
            'slug_id'             => 'UClaNUpRMzr73MrrKDX_WTcA',
            'slug_name'           => 't3chfest',
            'name'                => 't3chfest',
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'           => 1,
            'slug_id'             => 'UCPOAykv_UgFa79_mub4Orbw',
            'slug_name'           => 'carlos-buenosvinos',
            'name'                => 'Carlos Buenosvinos',
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);
        DB::table('youtube_channel')->insert([
            'source_id'           => 1,
            'slug_id'             => 'UCfFeLBv3iYU8ZnVswlO022A',
            'slug_name'           => 'devscola-vlc',
            'name'                => 'Devscola VLC',
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'           => 1,
            'slug_id'             => 'UCvdmEDFj2FtEdyaOW8zSjIA',
            'slug_name'           => 'desymfony',
            'name'                => 'Desymfony',
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'           => 1,
            'slug_id'             => 'UCQTmuJvtkHlXRQSrydoP_OA',
            'slug_name'           => 'hecho-en-laravel',
            'name'                => 'Hecho en Laravel',
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'           => 1,
            'slug_id'             => 'UCk_i1NppEfFSya1KRWy2_7Q',
            'slug_name'           => 'tarugoconf',
            'name'                => 'Tarugo Conf',
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'           => 1,
            'slug_id'             => 'UCN1fTyhkMLT2usKAtX8xxsA',
            'slug_name'           => 'symfony-valencia',
            'name'                => 'Symfony Valencia',
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'           => 1,
            'slug_id'             => 'UChbOHJuQ8Ex7DPkkv1r5Dug',
            'slug_name'           => 'php-madrid',
            'name'                => 'PHP Madrid',
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('youtube_channel')->insert([
            'source_id'           => 1,
            'slug_id'             => 'UCksw6qsw6vk7cp8sVwIpNrQ',
            'slug_name'           => 'software-craftsmanship-barcelona',
            'name'                => 'Software Craftsmanship Barcelona',
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

    }

}
