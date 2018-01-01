<?php

namespace Devoogle\Http\Controllers\Tag;

use Devoogle\Src\Tag\Query\SearchTagManager;
use Devoogle\Src\Tag\Query\SearchTagQuery;
use Spatie\Tags\Tag;

class SearchTagController
{

    public function __invoke(string $type)
    {
        \Debugbar::disable();

        $query = new SearchTagQuery(request()->get('q'), $type);
        $manager = app(SearchTagManager::class);

        $manager($query);

        return response()->json($manager->arrayTagsForInputForm());

    }
}
