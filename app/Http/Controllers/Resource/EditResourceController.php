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
        view()->share('formCreateVersion', $handler->getFormCreateVersion());
        view()->share('resource', $handler->resource());
        view()->share('versions', $handler->versions());
        view()->share('uuid', $uuid);

        return view('resource.form');
    }
}
