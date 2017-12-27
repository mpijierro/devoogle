<?php

namespace Mulidev\Http\Controllers\Tag;

use Mulidev\Src\Resource\Query\ListByTagManager;
use Mulidev\Src\Resource\Query\ListByTagQuery;

class HomeTagController
{

    public function __invoke(string $slug)
    {

        $query = new ListByTagQuery($slug);
        $manager = app(ListByTagManager::class);
        $view = $manager($query);

        view()->share('view', $view);

        return view('resource.list_by_tag');
    }
}
