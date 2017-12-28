<?php

namespace Devoogle\Http\Controllers\Version;


use Devoogle\Src\Version\Command\CheckVersionCommand;
use Devoogle\Src\Version\Command\CheckVersionHandler;
use Devoogle\Src\Version\Repository\VersionRepositoryRead;

/**
 * Mark a version as reviewed
 *
 * Class CheckResourceController
 * @package Devoogle\Http\Controllers\Resource
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
