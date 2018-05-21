<?php

namespace Devoogle\Http\Controllers\Viewed;

use Devoogle\Src\Viewed\Command\ToggleViewedCommand;
use Devoogle\Src\Viewed\Command\ToggleViewedHandler;

class ToggleViewedController
{

    public function __invoke(string $uuid)
    {

        $command = new ToggleViewedCommand($uuid, user()->id);
        $handler = app(ToggleViewedHandler::class);
        $handler($command);

        return back();

    }
}
