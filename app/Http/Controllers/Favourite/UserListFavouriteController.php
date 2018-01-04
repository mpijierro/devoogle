<?php

namespace Devoogle\Http\Controllers\Favourite;

use Devoogle\Src\Favourite\Query\FavouriteUserListManager;
use Devoogle\Src\Favourite\Query\FavouriteUserListQuery;

class UserListFavouriteController
{

    public function __invoke()
    {


        $query = new FavouriteUserListQuery(user()->id);
        $manager = app(FavouriteUserListManager::class);
        $manager($query);

        view()->share('view', $manager);
        view()->share('resources', $manager->favourites());

        //view()->share('paginator', $view->favourites()->links());

        return view('resource.list_user_favourite');

    }
}
