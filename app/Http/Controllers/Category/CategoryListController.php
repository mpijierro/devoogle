<?php

namespace Devoogle\Http\Controllers\Category;

use Devoogle\Src\Devoogle\Exceptions\InvalidPageNumberException;
use Devoogle\Src\Resource\Query\ListByCategoryManager;
use Devoogle\Src\Resource\Query\ListByCategoryQuery;

class CategoryListController
{

    public function __invoke(string $slug)
    {

        try {

            $query = new ListByCategoryQuery($slug);
            $manager = app(ListByCategoryManager::class);
            $view = $manager($query);

            view()->share('resources', $view->resources());
            view()->share('view', $view);
            view()->share('paginator', $view->resources()->links());

            return view('resource.list_by_category');
        } catch (InvalidPageNumberException $exception) {
            abort(404);
        }

    }
}
