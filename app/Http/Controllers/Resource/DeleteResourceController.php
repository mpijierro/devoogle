<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Resource\Command\DeleteResourceCommand;
use Devoogle\Src\Resource\Command\DeleteResourceHandler;
use Krucas\Notification\Facades\Notification;

class DeleteResourceController
{


    public function __invoke($aUuid)
    {

        $command = new DeleteResourceCommand($aUuid);
        $handler = app(DeleteResourceHandler::class);
        $handler($command);

        Notification::success(trans('resource.actions.resource.deleted_succesfully'));

        return redirect()->route('home');

    }
}
