<?php

namespace Devoogle\Http\Controllers\Tag;

use Devoogle\Src\Tag\Query\SearchTagManager;
use Devoogle\Src\Tag\Query\SearchTagQuery;
use Spatie\Tags\Tag;

class ApiController
{

    private $tags;

    public function __invoke()
    {


        \Debugbar::disable();


        $query = new SearchTagQuery(request()->get('q'));
        $manager = app(SearchTagManager::class);

        $manager($query);

        return response()->json($manager->arrayTagsForInputForm());

    }
}
