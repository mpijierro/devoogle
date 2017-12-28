<?php

namespace Mulidev\Http\Controllers\Resource;


use Mulidev\Src\Resource\Command\CheckResourceCommand;
use Mulidev\Src\Resource\Command\CheckResourceHandler;

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
        $command = new CheckResourceCommand($aUuid);

        $handler = app(CheckResourceHandler::class);
        $handler($command);

        return redirect()->route('home-resource');

    }
}
