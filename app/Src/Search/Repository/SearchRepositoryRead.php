<?php

namespace Devoogle\Src\Search\Repository;

use Devoogle\Src\Search\Model\Search;

class SearchRepositoryRead
{

    public function findBySlug(string $search)
    {

        $slug = str_slug($search);

        return Search::where('slug', $slug)->get();
    }

}