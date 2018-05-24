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
        view()->share('formTitle', trans('form.form_title_version'));
        view()->share('textButton', trans('form.text_button_add_version'));

        return view('resource.form_version');
    }
}
