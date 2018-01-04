<?php

namespace Devoogle\Http\Controllers\Later;

use Devoogle\Src\Later\Command\ToggleLaterCommand;
use Devoogle\Src\Later\Command\ToggleLaterHandler;

class ToggleLaterController
{
    public function __invoke(string $uuid)
    {

        $command = new ToggleLaterCommand($uuid, user()->id);
        $handler = app(ToggleLaterHandler::class);
        $handler($command);

        return back();

    }
}
