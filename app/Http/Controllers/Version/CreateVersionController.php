<?php

namespace Devoogle\Http\Controllers\Version;

use Devoogle\Src\Version\Query\CreateVersionManager;
use Devoogle\Src\Version\Query\CreateVersionQuery;

class CreateVersionController
{

    public function __invoke(string $uuid)
    {

        $query = new CreateVersionQuery($uuid);
        $manager = app(CreateVersionManager::class);
        $manager($query);

        view()->share('versions', $manager->versions());
        view()->share('resource', $manager->resource());
        view()->share('form', $manager->formCreate());
        view()->share('formTitle', '¿Sabes si existe este mismo contenido con otro formato? ¡Añádelo!');
        view()->share('textButton', 'Añadir formato');

        return view('resource.form_version');
    }
}
