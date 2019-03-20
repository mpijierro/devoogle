<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Devoogle\Exceptions\InvalidPageNumberException;
use Devoogle\Src\Resource\Query\SearchResourceManager;
use Devoogle\Src\Resource\Query\SearchResourceQuery;
use Devoogle\Src\Search\Command\StoreSearchCommand;
use Devoogle\Src\Search\Command\StoreSearchHandler;

class SearchResourceController
{

    public function __invoke()
    {

        try {

            if (request()->isMethod('post')){

                $command = new StoreSearchCommand(request()->get('search'));
                $handler = app(StoreSearchHandler::class);
                $handler($command);

                return redirect(route('search-resource-get', ['search' => str_slug(request()->get('search'))]));
            }

            $query = new SearchResourceQuery(str_replace('-', ' ',request()->get('search')));
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
