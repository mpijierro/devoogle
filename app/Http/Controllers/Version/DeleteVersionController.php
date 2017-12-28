<?php

namespace Mulidev\Http\Controllers\Version;

use Illuminate\Support\Facades\DB;
use Mulidev\Src\Version\Command\DeleteVersionCommand;
use Mulidev\Src\Version\Command\DeleteVersionHandler;
use Mulidev\Src\Version\Repository\VersionRepositoryRead;

class DeleteVersionController
{


    public function __invoke(VersionRepositoryRead $versionRepositoryRead, $aUuid)
    {

        $version = $versionRepositoryRead->findByUuid($aUuid);

        $command = new DeleteVersionCommand($aUuid);
        $handler = app(DeleteVersionHandler::class);
        $handler($command);

        return redirect()->route('edit-resource', $version->resource->uuid());

    }
}
