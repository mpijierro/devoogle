<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Resource\Query\HomeResourceManager;

class HomeResourceController
{

    public function __invoke()
    {

        $view = app(HomeResourceManager::class);
        $view();

        view()->share('view', $view);

        return view('resource.home');
    }
}
