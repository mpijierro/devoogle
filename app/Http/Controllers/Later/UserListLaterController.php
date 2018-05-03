<?php

namespace Devoogle\Http\Controllers\Later;

use Devoogle\Src\Devoogle\Exceptions\InvalidPageNumberException;
use Devoogle\Src\Later\Query\LaterUserListManager;
use Devoogle\Src\Later\Query\LaterUserListQuery;

class UserListLaterController
{

    public function __invoke()
    {


        $query = new LaterUserListQuery(user()->id);
        $manager = app(LaterUserListManager::class);
        $manager($query);

        view()->share('view', $manager);
        view()->share('resources', $manager->laters());

        return view('resource.list_user_later');

    }
}
