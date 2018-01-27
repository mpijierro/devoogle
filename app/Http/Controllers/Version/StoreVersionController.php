<?php

namespace Devoogle\Http\Controllers\Version;

use Devoogle\Src\Version\Command\StoreVersionCommand;
use Devoogle\Src\Version\Command\StoreVersionHandler;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Devoogle\Src\Version\Request\StoreVersionRequest;
use Krucas\Notification\Facades\Notification;
use Webpatser\Uuid\Uuid;

class StoreVersionController
{


    public function __invoke(StoreVersionRequest $request, string $parentUuid)
    {

        try {

            DB::beginTransaction();

            $user = Auth::user();
            $uuid = Uuid::generate();

            $command = new StoreVersionCommand($uuid, $parentUuid, $user->id, $request->get('category_id'), $request->get('url'), request('comment', $default = ''));
            $handler = app(StoreVersionHandler::class);
            $handler($command);

            DB::commit();

            Notification::success(trans('resource.actions.version.created_succesfully'));

            return redirect()->route('edit-version', $uuid);

        } catch (\Exception $exception) {

            DB::rollback();

            throw  $exception;
        }

    }
}
