<?php

namespace Mulidev\Http\Controllers\Resource;

use Mulidev\Src\Resource\Command\CreateResourceCommand;
use Mulidev\Src\Resource\Command\CreateResourceHandler;

class CreateResourceController
{


    public function __invoke()
    {

        $command = new CreateResourceCommand();
        $handler = app(CreateResourceHandler::class);

        $handler($command);

        view()->share('form', $handler->getFormCreate());

        return view('resource.form');
    }
}
