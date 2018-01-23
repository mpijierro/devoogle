<?php

namespace Devoogle\Http\Controllers\Profile;

use Devoogle\Src\Profile\Query\AddedUserListManager;
use Devoogle\Src\Profile\Query\AddedUserListQuery;

class UserListAddedController
{

    public function __invoke()
    {

        $query = new AddedUserListQuery(user()->id);
        $manager = app(AddedUserListManager::class);
        $manager($query);

        view()->share('view', $manager);
        view()->share('resources', $manager->addedResources());

        //view()->share('paginator', $view->favourites()->links());

        return view('resource.list_user_added_resources');

    }
}
