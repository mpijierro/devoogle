<?php

namespace Devoogle\Http\Controllers\Tag;

use Devoogle\Src\Devoogle\Exceptions\InvalidPageNumberException;
use Devoogle\Src\Resource\Query\ListByTagManager;
use Devoogle\Src\Resource\Query\ListByTagQuery;

class TagListController
{

    public function __invoke(string $slug)
    {

        try {

            $query = new ListByTagQuery($slug);
            $manager = app(ListByTagManager::class);
            $view = $manager($query);

            view()->share('view', $view);
            view()->share('resources', $view->resources());
            view()->share('paginator', $view->resources()->links());


            return view('resource.list_by_tag');
        } catch (InvalidPageNumberException $exception) {
            abort(404);
        }

    }
}
