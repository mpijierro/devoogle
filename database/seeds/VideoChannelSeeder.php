<?php

use Illuminate\Database\Seeder;

class VideoChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('video_channel')->insert([
            'platform_id'         => 1,
            'slug_id'             => 'UCvZ6HKYcDtqtK1SfbIpB97g',
            'slug_name'           => 'autentia-media',
            'name'                => 'AutentiaMedia',
            'last_time_processed' => null,
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('video_channel')->insert([
            'platform_id'         => 1,
            'slug_id'             => 'UC9IKtxn9AIGelnYmwYr0Lxw',
            'slug_name'           => 'codely-tv',
            'name'                => 'CodelyTv',
            'last_time_processed' => null,
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('video_channel')->insert([
            'platform_id'         => 1,
            'slug_id'             => 'UCDUS9HwdxHp9DjI0nRDrR0A',
            'slug_name'           => 'beta-beers',
            'name'                => 'Beta beers',
            'last_time_processed' => null,
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('video_channel')->insert([
            'platform_id'         => 1,
            'slug_id'             => 'UCh79t1YY9nZVfawaV3xOZNQ',
            'slug_name'           => 'geekshub-academy',
            'name'                => 'GeeksHubs Academy',
            'last_time_processed' => null,
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('video_channel')->insert([
            'platform_id'         => 1,
            'slug_id'             => 'UCDJARuPiO4QX2o-rpEEGOXA',
            'slug_name'           => 'comunidad-code',
            'name'                => 'Comunidad CODE',
            'last_time_processed' => null,
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('video_channel')->insert([
            'platform_id'         => 1,
            'slug_id'             => 'UClaNUpRMzr73MrrKDX_WTcA',
            'slug_name'           => 't3chfest',
            'name'                => 't3chfest',
            'last_time_processed' => null,
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('video_channel')->insert([
            'platform_id'         => 1,
            'slug_id'             => 'UCPOAykv_UgFa79_mub4Orbw',
            'slug_name'           => 'carlos-buenosvinos',
            'name'                => 'Carlos Buenosvinos',
            'last_time_processed' => null,
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);
        DB::table('video_channel')->insert([
            'platform_id'         => 1,
            'slug_id'             => 'UCfFeLBv3iYU8ZnVswlO022A',
            'slug_name'           => 'devscola-vlc',
            'name'                => 'Devscola VLC',
            'last_time_processed' => null,
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('video_channel')->insert([
            'platform_id'         => 1,
            'slug_id'             => 'UCvdmEDFj2FtEdyaOW8zSjIA',
            'slug_name'           => 'desymfony',
            'name'                => 'Desymfony',
            'last_time_processed' => null,
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('video_channel')->insert([
            'platform_id'         => 1,
            'slug_id'             => 'UCQTmuJvtkHlXRQSrydoP_OA',
            'slug_name'           => 'hecho-en-laravel',
            'name'                => 'Hecho en Laravel',
            'last_time_processed' => null,
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('video_channel')->insert([
            'platform_id'         => 1,
            'slug_id'             => 'UCk_i1NppEfFSya1KRWy2_7Q',
            'slug_name'           => 'tarugoconf',
            'name'                => 'Tarugo Conf',
            'last_time_processed' => null,
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('video_channel')->insert([
            'platform_id'         => 1,
            'slug_id'             => 'UCN1fTyhkMLT2usKAtX8xxsA',
            'slug_name'           => 'symfony-valencia',
            'name'                => 'Symfony Valencia',
            'last_time_processed' => null,
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('video_channel')->insert([
            'platform_id'         => 1,
            'slug_id'             => 'UChbOHJuQ8Ex7DPkkv1r5Dug',
            'slug_name'           => 'php-madrid',
            'name'                => 'PHP Madrid',
            'last_time_processed' => null,
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

        DB::table('video_channel')->insert([
            'platform_id'         => 1,
            'slug_id'             => 'UCksw6qsw6vk7cp8sVwIpNrQ',
            'slug_name'           => 'software-craftsmanship-barcelona',
            'name'                => 'Software Craftsmanship Barcelona',
            'last_time_processed' => null,
            'created_at'          => \Carbon\Carbon::now(),
            'updated_at'          => \Carbon\Carbon::now(),
        ]);

    }

}
