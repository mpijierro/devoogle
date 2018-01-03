<?php

namespace Devoogle\Http\Controllers\Favourite;

use Devoogle\Src\Favourite\Command\MarkFavouriteCommand;
use Devoogle\Src\Favourite\Command\MarkFavouriteHandler;

class MarkFavouriteController
{
    public function __invoke(string $uuid)
    {

        $command = new MarkFavouriteCommand($uuid, user()->id);
        $handler = app(MarkFavouriteHandler::class);
        $handler($command);

        return back();

    }
}
