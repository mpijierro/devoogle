<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Resource\Command\CheckResourceCommand;
use Devoogle\Src\Resource\Command\CheckResourceHandler;

/**
 * Mark a resource as reviewed
 *
 * Class CheckResourceController
 * @package Devoogle\Http\Controllers\Resource
 */
class CheckResourceController
{

    public function __invoke(string $aUuid)
    {
        $command = new CheckResourceCommand($aUuid);

        $handler = app(CheckResourceHandler::class);
        $handler($command);

        return redirect()->route('home-resource');

    }
}
