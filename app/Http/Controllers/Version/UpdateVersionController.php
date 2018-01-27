<?php

namespace Devoogle\Http\Controllers\Version;

use Illuminate\Support\Facades\DB;
use Devoogle\Src\Version\Command\UpdateVersionCommand;
use Devoogle\Src\Version\Command\UpdateVersionHandler;
use Devoogle\Src\Version\Repository\VersionRepositoryRead;
use Devoogle\Src\Version\Request\UpdateVersionRequest;
use Krucas\Notification\Facades\Notification;

class UpdateVersionController
{


    public function __invoke(UpdateVersionRequest $request, string $aUuid)
    {

        try {

            $command = new UpdateVersionCommand($aUuid, $request->get('category_id'), $request->get('url'), $request->get('comment', $default = ''));
            $handler = app(UpdateVersionHandler::class);
            $handler($command);

            Notification::success(trans('resource.actions.version.updated_succesfully'));

            return redirect()->route('edit-version', $aUuid);

        } catch (\Exception $exception) {

            DB::rollback();

            return back()->withInput();
        }

    }
}
