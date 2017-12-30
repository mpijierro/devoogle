<?php

namespace Devoogle\Http\Controllers\Category;

use Devoogle\Src\Resource\Query\ListByCategoryManager;
use Devoogle\Src\Resource\Query\ListByCategoryQuery;

class CategoryListController
{

    public function __invoke(string $slug)
    {

        $query = new ListByCategoryQuery($slug);
        $manager = app(ListByCategoryManager::class);
        $view = $manager($query);

        view()->share('resources', $view->resources());
        view()->share('view', $view);

        return view('resource.list_by_category');
    }
}
