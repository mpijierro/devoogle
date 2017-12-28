<?php

namespace Mulidev\Http\Controllers\Version;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mulidev\Src\Version\Command\StoreVersionCommand;
use Mulidev\Src\Version\Command\StoreVersionHandler;
use Mulidev\Src\Version\Request\StoreVersionRequest;
use Webpatser\Uuid\Uuid;

class StoreVersionController
{


    public function __invoke(StoreVersionRequest $request, string $parentUuid)
    {

        try {

            DB::beginTransaction();

            $user = Auth::user();
            $uuid = Uuid::generate();

            $command = new StoreVersionCommand($uuid, $parentUuid, $user->id, $request->get('category_id'), $request->get('url'), $request->get('comment', $default = ''));
            $handler = app(StoreVersionHandler::class);
            $handler($command);

            DB::commit();

            return redirect()->route('edit-resource', $parentUuid);

        } catch (\Exception $exception) {

            DB::rollback();

            throw  $exception;
        }

    }
}
