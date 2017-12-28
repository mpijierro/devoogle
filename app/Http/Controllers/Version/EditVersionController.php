<?php

namespace Devoogle\Http\Controllers\Version;

use Devoogle\Src\Resource\Query\EditResourceManager;
use Devoogle\Src\Resource\Query\EditResourceQuery;
use Devoogle\Src\Version\Query\EditVersionManager;
use Devoogle\Src\Version\Query\EditVersionQuery;

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
