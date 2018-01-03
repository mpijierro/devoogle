<?php

namespace Devoogle\Http\Controllers\Version;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Devoogle\Src\Version\Command\MarkFavouriteCommand;
use Devoogle\Src\Version\Command\MarkFavouriteHandler;
use Devoogle\Src\Version\Request\StoreVersionRequest;
use Webpatser\Uuid\Uuid;

class StoreVersionController
{


    public function __invoke(StoreVersionRequest $request, string $parentUuid)
    {

        try {

            DB::beginTransaction();

            $user = Auth::user();
            $uuid = Uuid::generate();

            $command = new MarkFavouriteCommand($uuid, $parentUuid, $user->id, $request->get('category_id'), $request->get('url'), request('comment', $default = ''));
            $handler = app(MarkFavouriteHandler::class);
            $handler($command);

            DB::commit();

            return redirect()->route('edit-version', $uuid);

        } catch (\Exception $exception) {

            DB::rollback();

            throw  $exception;
        }

    }
}
