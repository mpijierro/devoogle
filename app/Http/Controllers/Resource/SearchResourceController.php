<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Resource\Query\SearchResourceManager;
use Devoogle\Src\Resource\Query\SearchResourceQuery;

class SearchResourceController
{

    public function __invoke()
    {

        $query = new SearchResourceQuery(request()->get('search'));
        $manager = app(SearchResourceManager::class);
        $view = $manager($query);

        view()->share('view', $view);

        return view('resource.list_by_search');
    }
}
