<?php

namespace Mulidev\Http\Controllers\Resource;

use Mulidev\Src\Resource\Command\DeleteResourceCommand;
use Mulidev\Src\Resource\Command\DeleteResourceHandler;

class DeleteResourceController
{


    public function __invoke($aUuid)
    {

        $command = new DeleteResourceCommand($aUuid);
        $handler = app(DeleteResourceHandler::class);
        $handler($command);

        return redirect()->route('home-resource');

    }
}
