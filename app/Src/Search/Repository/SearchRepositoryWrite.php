<?php

namespace Devoogle\Src\Search\Repository;

use Devoogle\Src\Search\Model\Search;

class SearchRepositoryWrite
{

    public function save(Search $search)
    {
        return $search->save();
    }

}