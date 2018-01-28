<?php

namespace Devoogle\Http\Controllers\Version;

use Devoogle\Src\Version\Command\DeleteVersionCommand;
use Devoogle\Src\Version\Command\DeleteVersionHandler;
use Devoogle\Src\Version\Repository\VersionRepositoryRead;
use Krucas\Notification\Facades\Notification;

class DeleteVersionController
{


    public function __invoke(VersionRepositoryRead $versionRepositoryRead, $aUuid)
    {

        $version = $versionRepositoryRead->findByUuid($aUuid);

        $command = new DeleteVersionCommand($aUuid);
        $handler = app(DeleteVersionHandler::class);
        $handler($command);

        Notification::success(trans('resource.actions.version.deleted_succesfully'));

        return redirect()->route('edit-resource', $version->resource->uuid());

    }
}
