<?php

namespace Mulidev\Http\Controllers\Resource;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Mulidev\Src\Resource\Command\StoreResourceCommand;
use Mulidev\Src\Resource\Command\StoreResourceHandler;
use Mulidev\Src\Resource\Request\StoreResourceRequest;
use Webpatser\Uuid\Uuid;

class StoreResourceController
{


    public function __invoke(StoreResourceRequest $request)
    {

        try {

            DB::beginTransaction();

            $user = Auth::user();
            $uuid = Uuid::generate();

            $command = new StoreResourceCommand($uuid, $user->id, $request->get('title'), $request->get('description'), $request->get('url'), $request->get('category_id'), $request->get('lang_id'),
                request('tag', $default = ''), request('comment', $default = ''));
            $handler = app(StoreResourceHandler::class);
            $handler($command);

            DB::commit();

            return redirect()->route('edit-resource', $uuid);

        } catch (\Exception $exception) {

            DB::rollback();

            throw  $exception;
        }

    }
}
