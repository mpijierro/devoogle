<?php

namespace Devoogle\Src\Lang\Repository;

use Devoogle\Src\Lang\Model\Lang;

class LangRepositoryRead
{

    public function find($aLangId)
    {
        return Lang::find($aLangId);
    }


    public function allOrderByName()
    {
        return Lang::orderBy('name', 'asc')->get();
    }


    public function findByCode(string $code)
    {
        return Lang::where('code', $code)->firstOrFail();
    }
}