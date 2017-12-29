<?php

namespace Devoogle\Http\Controllers\Tag;

use Devoogle\Src\Resource\Query\ListByTagManager;
use Devoogle\Src\Resource\Query\ListByTagQuery;

class TagListController
{

    public function __invoke(string $slug)
    {

        $query = new ListByTagQuery($slug);
        $manager = app(ListByTagManager::class);
        $view = $manager($query);

        view()->share('view', $view);
        view()->share('resources', $view->resources());


        return view('resource.list_by_tag');
    }
}
