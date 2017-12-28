<?php

namespace Mulidev\Http\Controllers\Version;

use Illuminate\Support\Facades\DB;
use Mulidev\Src\Version\Command\UpdateVersionCommand;
use Mulidev\Src\Version\Command\UpdateVersionHandler;
use Mulidev\Src\Version\Repository\VersionRepositoryRead;
use Mulidev\Src\Version\Request\UpdateVersionRequest;

class UpdateVersionController
{


    public function __invoke(UpdateVersionRequest $request, VersionRepositoryRead $versionRepositoryRead, string $aUuid)
    {

        try {

            $command = new UpdateVersionCommand($aUuid, $request->get('category_id'), $request->get('url'), $request->get('comment', $default = ''));
            $handler = app(UpdateVersionHandler::class);
            $handler($command);

            $version = $versionRepositoryRead->findByUuid($aUuid);

            return redirect()->route('edit-resource', $version->resource->uuid());

        } catch (\Exception $exception) {

            DB::rollback();

            return back()->withInput();
        }

    }
}
