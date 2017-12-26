<?php

namespace Mulidev\Src\Lang\Repository;

use Mulidev\Src\Lang\Model\Lang;

class LangRepository
{

    public function allOrderByName()
    {
        return Lang::orderBy('name', 'asc')->get();
    }

}