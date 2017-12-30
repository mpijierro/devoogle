<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Devoogle\Exceptions\InvalidPageNumberException;
use Devoogle\Src\Resource\Query\SearchResourceManager;
use Devoogle\Src\Resource\Query\SearchResourceQuery;

class SearchResourceController
{

    public function __invoke()
    {

        try {

            $query = new SearchResourceQuery(request()->get('search'));
            $manager = app(SearchResourceManager::class);
            $view = $manager($query);

            view()->share('view', $view);
            view()->share('resources', $view->resources());
            view()->share('paginator', $view->paginator());

            return view('resource.list_by_search');

        } catch (InvalidPageNumberException $exception) {
            abort(404);
        }

    }
}
