<?php

namespace Devoogle\Http\Controllers\Viewed;

use Devoogle\Src\Devoogle\Exceptions\InvalidPageNumberException;
use Devoogle\Src\Viewed\Query\ViewedUserListManager;
use Devoogle\Src\Viewed\Query\ViewedUserListQuery;

class UserListViewedController
{

    public function __invoke()
    {


        $query = new ViewedUserListQuery(user()->id);
        $manager = app(ViewedUserListManager::class);
        $manager($query);

        view()->share('view', $manager);
        view()->share('resources', $manager->vieweds());

        return view('resource.list_user_viewed');

    }
}
