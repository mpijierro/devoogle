<?php

namespace Mulidev\Http\Controllers\Media;

use Mulidev\Src\Media\Command\CreateMediaCommand;
use Mulidev\Src\Media\Command\CreateMediaHandler;

class CreateMediaController
{


    public function __invoke()
    {

        $command = new CreateMediaCommand();
        $handler = app(CreateMediaHandler::class);

        $handler($command);

        view()->share('formCreate', $handler->getFormCreate());

        return view('media.form');
    }
}
