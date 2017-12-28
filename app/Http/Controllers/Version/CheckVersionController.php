<?php

namespace Mulidev\Http\Controllers\Version;


use Mulidev\Src\Version\Command\CheckVersionCommand;
use Mulidev\Src\Version\Command\CheckVersionHandler;
use Mulidev\Src\Version\Repository\VersionRepositoryRead;

/**
 * Mark a version as reviewed
 *
 * Class CheckResourceController
 * @package Mulidev\Http\Controllers\Resource
 */
class CheckVersionController
{

    public function __invoke(VersionRepositoryRead $versionRepositoryRead, string $aUuid)
    {
        $command = new CheckVersionCommand($aUuid);

        $handler = app(CheckVersionHandler::class);
        $handler($command);

        $version = $versionRepositoryRead->findByUuid($aUuid);

        return redirect()->route('edit-resource', $version->resource->uuid());

    }
}
