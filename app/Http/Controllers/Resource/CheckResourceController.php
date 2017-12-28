<?php

namespace Mulidev\Http\Controllers\Resource;


use Mulidev\Src\Resource\Command\CheckVersionCommand;
use Mulidev\Src\Resource\Command\CheckVersionHandler;

/**
 * Mark a resource as reviewed
 *
 * Class CheckResourceController
 * @package Mulidev\Http\Controllers\Resource
 */
class CheckResourceController
{

    public function __invoke(string $aUuid)
    {
        $command = new CheckVersionCommand($aUuid);

        $handler = app(CheckVersionHandler::class);
        $handler($command);

        return redirect()->route('home-resource');

    }
}
