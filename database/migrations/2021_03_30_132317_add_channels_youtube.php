<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChannelsYoutube extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->addById('UC8LeXCWOalN8SxlrPcG-PaQ', 'midudev', 'midudev');
        $this->addById('UCxPD7bsocoAMq8Dj18kmGyQ', 'moureddev', 'MoureDev');
        $this->addById('UCSf6S_PAhXsqGMTPDiKgdRg', 'betta-tech', 'BettaTech');
        $this->addById('UCDUdeFslCNoM29MAlZOfdWQ', 'deleon', 'hdeleon.net');
        $this->addById('UClk6ZM2sM04tofDdFro8pag', 'kiko-palomares', 'Kiko Palomares');

        $this->addById('UCf_ymsPEZLmSM7_OvLF87KQ', 'julian-duque', 'Julián Duque');
        $this->addById('UCLsSfk2x6p3XvlknDi39zCQ', 'leonidas-esteban', 'Leónidas Esteban');
        $this->addById('UCw05fUBPwmpu-ehXFMqfdMw', 'oscar-barajas', 'Oscar Barajas');
        $this->addById('UCA9rep71JxeR7tZotHqFDig', 'guillermo-rodas', 'Guillermo Rodas');
        $this->addById('UCzTi9I3zApECTkukkMOpEEA', 'antonio-sarosi', 'Antonio Sarosi');

        $this->addById('UCvnoM0R1sDKm-YCPifEso_g', 'absolute', 'absolute');
        $this->addById('UCX9NJ471o7Wie1DQe94RVIg', 'fazt', 'Fazt');
        $this->addById('UCjXAQ-cayM4mIZmUZKMFW_w', 'programador-x', 'Programador X');
        $this->addById('UCl41m8HBifhzM6Dh1V04wqA', 'pablo-sirera', 'Pablo Sirera');
        $this->addById('UChE1i1V9J06_yfx4NyAMyyA', 'joan-leon', 'Joan Leon');

        $this->addById('UCsT4m6bDGW0y0Zje_dXuCqg', 'jorge-casar', 'Jorge Casar');
        $this->addById('UC3QuZuJr2_EOUak8bWUd74A', 'domini-code', 'Domini Code');
        $this->addById('UCzuwt7Pi_VB8cP5q5UE4u-A', 'dorian-desings', 'Dorian Desings');
        $this->addById('UCY2ogSxB2beBNBRMKU_dXzA', 'la-cocina-de-codigo', 'La Cocina del Código');
        $this->addById('UCtoo4_P6ilCj7jwa4FmA5lQ', 'soy-dalto', 'Soy Dalto');

        $this->addById('UCTTj5ztXnGeDRPFVsBp7VMA', 'rambito-js', 'Rambito JS');
        $this->addById('UCPbFiM-HA4lwJH12JXdXxDA', 'ada-lovecode-didacticode', 'Ada Lovecode - Didacticode');
        $this->addById('UCpQ-bXwyPRgA0qHcmD1fwow', 'bytes-and-humans ', 'BytesAndHumans ');
    }

    private function addById (string $slugId, string $slugName, string $name){

        DB::table('youtube_channel')->insert([
             'source_id'       => 1,
             'slug_id'         => $slugId,
             'slug_name'       => $slugName,
             'name'            => $name,
             'is_user_channel' => false,

             'created_at' => \Carbon\Carbon::now(),
             'updated_at' => \Carbon\Carbon::now(),
         ]);

    }
}
