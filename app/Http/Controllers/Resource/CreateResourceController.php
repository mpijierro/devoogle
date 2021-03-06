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

        view()->share('titleForm', 'Crear recurso');
        view()->share('textActionButton', 'Crear');
        view()->share('loadTagManager', true);

        return view('resource.form');
    }
}
