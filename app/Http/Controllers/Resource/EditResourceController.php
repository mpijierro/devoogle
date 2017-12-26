<?php

namespace Mulidev\Http\Controllers\Resource;

use Mulidev\Src\Resource\Query\EditResourceManager;
use Mulidev\Src\Resource\Query\EditResourceQuery;

class EditResourceController
{


    public function __invoke($uuid)
    {

        $query = new EditResourceQuery($uuid);
        $handler = app(EditResourceManager::class);
        $handler($query);

        view()->share('form', $handler->getFormEdit());
        view()->share('uuid', $uuid);

        return view('resource.form');
    }
}
