<?php

namespace Mulidev\Http\Controllers\Version;


use Mulidev\Src\Resource\Query\CreateResourceManager;

class CreateVersionController
{

    public function __invoke()
    {

        $handler = app(CreateResourceManager::class);
        $handler();

        view()->share('form', $handler->getFormCreate());

        return view('resource.form');
    }
}
