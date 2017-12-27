<?php

namespace Mulidev\Http\Controllers\Category;

use Mulidev\Src\Resource\Query\ListByCategoryManager;
use Mulidev\Src\Resource\Query\ListByCategoryQuery;

class CategoryListController
{

    public function __invoke(string $slug)
    {

        $query = new ListByCategoryQuery($slug);
        $manager = app(ListByCategoryManager::class);
        $view = $manager($query);

        view()->share('view', $view);

        return view('resource.list_by_category');
    }
}
