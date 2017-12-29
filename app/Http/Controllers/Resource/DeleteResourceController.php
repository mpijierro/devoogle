<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Resource\Command\DeleteResourceCommand;
use Devoogle\Src\Resource\Command\DeleteResourceHandler;

class DeleteResourceController
{


    public function __invoke($aUuid)
    {

        $command = new DeleteResourceCommand($aUuid);
        $handler = app(DeleteResourceHandler::class);
        $handler($command);

        return redirect()->route('home');

    }
}
