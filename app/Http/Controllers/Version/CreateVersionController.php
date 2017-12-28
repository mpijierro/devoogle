<?php

namespace Devoogle\Http\Controllers\Version;


use Devoogle\Src\Resource\Query\CreateResourceManager;

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
