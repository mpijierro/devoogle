<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Resource\Query\EditResourceManager;
use Devoogle\Src\Resource\Query\EditResourceQuery;

class EditResourceController
{


    public function __invoke($uuid)
    {

        $query = new EditResourceQuery($uuid);
        $handler = app(EditResourceManager::class);
        $handler($query);

        view()->share('form', $handler->getFormEdit());
        view()->share('resource', $handler->resource());
        view()->share('versions', $handler->versions());
        view()->share('uuid', $uuid);

        view()->share('titleForm', 'Actualizar recurso');
        view()->share('textActionButton', 'Actualizar');


        return view('resource.form');
    }
}
