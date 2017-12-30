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
        $manager = app(EditVersionManager::class);
        $manager($query);

        view()->share('versions', $manager->versions());
        view()->share('resource', $manager->resource());
        view()->share('form', $manager->formEdit());
        view()->share('formTitle', 'Actualizar formato');
        view()->share('textButton', 'Actualizar');

        return view('resource.form_version');

    }
}
