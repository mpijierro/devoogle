<?php

namespace Devoogle\Http\Controllers\Favourite;

use Devoogle\Src\Favourite\Command\ToggleFavouriteCommand;
use Devoogle\Src\Favourite\Command\ToggleFavouriteHandler;

class ToggleFavouriteController
{
    public function __invoke(string $uuid)
    {

        $command = new ToggleFavouriteCommand($uuid, user()->id);
        $handler = app(ToggleFavouriteHandler::class);
        $handler($command);

        return back();

    }
}
