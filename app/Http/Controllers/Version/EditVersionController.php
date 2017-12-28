<?php

namespace Mulidev\Http\Controllers\Version;

use Mulidev\Src\Resource\Query\EditResourceManager;
use Mulidev\Src\Resource\Query\EditResourceQuery;
use Mulidev\Src\Version\Query\EditVersionManager;
use Mulidev\Src\Version\Query\EditVersionQuery;

class EditVersionController
{


    public function __invoke($uuid)
    {

        $query = new EditVersionQuery($uuid);
        $handler = app(EditVersionManager::class);
        $handler($query);

        view()->share('form', $handler->formEdit());
        view()->share('version', $handler->version());
        view()->share('uuid', $uuid);

        return view('resource.version_edit');
    }
}
