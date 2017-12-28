<?php

namespace Mulidev\Http\Controllers\Resource;

use Mulidev\Src\Resource\Command\DeleteVersionCommand;
use Mulidev\Src\Resource\Command\DeleteVersionHandler;

class DeleteResourceController
{


    public function __invoke($aUuid)
    {

        $command = new DeleteVersionCommand($aUuid);
        $handler = app(DeleteVersionHandler::class);
        $handler($command);

        return redirect()->route('home-resource');

    }
}
