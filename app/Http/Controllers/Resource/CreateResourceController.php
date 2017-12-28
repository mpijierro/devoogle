<?php

namespace Devoogle\Http\Controllers\Resource;


use Devoogle\Src\Resource\Query\CreateResourceManager;

class CreateResourceController
{

    public function __invoke()
    {

        $handler = app(CreateResourceManager::class);
        $handler();

        view()->share('form', $handler->getFormCreate());

        return view('resource.form');
    }
}
