<?php

namespace Mulidev\Src\Lang\Repository;

use Mulidev\Src\Lang\Model\Lang;

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

}