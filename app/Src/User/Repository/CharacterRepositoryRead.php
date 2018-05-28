<?php

namespace Devoogle\Src\User\Repository;

use Illuminate\Support\Facades\DB;

class CharacterRepositoryRead
{
    public function random()
    {
        return DB::table('character')->inRandomOrder()->first();
    }
}