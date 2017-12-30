<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Devoogle\Exceptions\InvalidPageNumberException;
use Devoogle\Src\Resource\Query\HomeResourceManager;

class HomeResourceController
{

    public function __invoke()
    {

        try {
            $view = app(HomeResourceManager::class);
            $view();

            view()->share('resources', $view->resources());
            view()->share('paginator', $view->resources()->links());

            return view('resource.home');
        } catch (InvalidPageNumberException $exception) {
            abort(404);
        }


    }
}
