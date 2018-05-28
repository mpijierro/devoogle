<?php

namespace Devoogle\Src\User\Repository;

class CharacterRepositoryRead
{
    public function random()
    {
        return DB::table('character')->inRandomOrder()->first();
    }
}