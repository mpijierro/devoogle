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

        $this->addChannel('aprendiendotdd', 'aprendiendo-tdd', 'Aprendiendo TDD', true);

        $this->addChannel('agilespain', 'agile-spain', 'Agile Spain', true);

        $this->addChannel('UCvZ6HKYcDtqtK1SfbIpB97g', 'autentia-media', 'AutentiaMedia');

        $this->addChannel('UCDUS9HwdxHp9DjI0nRDrR0A', 'beta-beers', 'Beta beers');

        $this->addChannel('UCeN__L88Wn3Aq2lz2Ps795g', 'Comunicación-biko', 'Comunicación Biko');

        $this->addChannel('UCPOAykv_UgFa79_mub4Orbw', 'carlos-buenosvinos', 'Carlos Buenosvinos');

        $this->addChannel('UC9IKtxn9AIGelnYmwYr0Lxw', 'codely-tv', 'CodelyTv');

        $this->addChannel('UCd_1KHg4t2VKGsSDF8OD5Cw', 'commit-conf', 'Commit Conf');

        $this->addChannel('UCDJARuPiO4QX2o-rpEEGOXA', 'comunidad-code', 'Comunidad CODE');

        $this->addChannel('UCvdmEDFj2FtEdyaOW8zSjIA', 'desymfony', 'Desymfony');

        $this->addChannel('UCfFeLBv3iYU8ZnVswlO022A', 'devscola-vlc', 'Devscola VLC');

        $this->addChannel('UCh79t1YY9nZVfawaV3xOZNQ', 'geekshub-academy', 'GeeksHubs Academy');

        $this->addChannel('UCQTmuJvtkHlXRQSrydoP_OA', 'hecho-en-laravel', 'Hecho en Laravel');

        $this->addChannel('UCSdjrn9u1AiXQdopOQvl6kg', 'javier-garzas', 'Javier Garzás');

        $this->addChannel('UCk_i1NppEfFSya1KRWy2_7Q', 'tarugoconf', 'Tarugo Conf');

        $this->addChannel('UCTRJkDjGNX3kId6RhxgIOmw', 'php-barcelona', 'PHP Barcelona');

        $this->addChannel('UC9fCYdf5eZLCkJcTAqSd0eA', 'php-conference-argentina', 'PHP Conference Argentina');

        $this->addChannel('UChbOHJuQ8Ex7DPkkv1r5Dug', 'php-madrid', 'PHP Madrid');

        $this->addChannel('phpvalencia', 'php-valencia', 'PHP valencia', true);

        $this->addChannel('UCksw6qsw6vk7cp8sVwIpNrQ', 'software-craftsmanship-barcelona', 'Software Craftsmanship Barcelona');

        $this->addChannel('UCN1fTyhkMLT2usKAtX8xxsA', 'symfony-valencia', 'Symfony Valencia');

        $this->addChannel('UClaNUpRMzr73MrrKDX_WTcA', 't3chfest', 'T3chfest');

        $this->addChannel('UCeYUif57MgyHExfax5cNWMA', 'xavi-gost', 'Xavi Gost');

        $this->addChannel('UC_u4aJMiMb2cz0KurfROyEA', 'tecnofor', 'Tecnofor Ibérica');
    }


    private function addChannel(string $id, string $slugName, string $name, bool $isUserChannel = false)
    {
        DB::table('youtube_channel')->insert([
            'source_id'       => 1,
            'slug_id'         => $id,
            'slug_name'       => $slugName,
            'name'            => $name,
            'is_user_channel' => $isUserChannel,

            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ]);
    }

}
