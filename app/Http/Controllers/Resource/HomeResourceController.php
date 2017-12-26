<?php

namespace Mulidev\Http\Controllers\Resource;

use Mulidev\Src\Resource\Command\CreateResourceCommand;
use Mulidev\Src\Resource\Command\CreateResourceHandler;
use Mulidev\Src\Resource\Query\HomeResourceManager;

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
