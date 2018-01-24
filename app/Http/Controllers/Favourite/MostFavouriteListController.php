<?php

namespace Devoogle\Http\Controllers\Favourite;

use Devoogle\Src\Favourite\Query\MostFavouriteListManager;

class MostFavouriteListController
{

    public function __invoke()
    {

        $manager = app(MostFavouriteListManager::class);
        $manager();

        view()->share('view', $manager);
        view()->share('resources', $manager->resources());
        view()->share('showCountFavourite', true);

        return view('resource.list_most_favourite');

    }
}
