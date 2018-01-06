<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Tag\Model\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Devoogle\Src\Resource\Command\StoreResourceCommand;
use Devoogle\Src\Resource\Command\StoreResourceHandler;
use Devoogle\Src\Resource\Request\StoreResourceRequest;
use Webpatser\Uuid\Uuid;

class StoreResourceController
{


    public function __invoke(StoreResourceRequest $request)
    {

        try {

            DB::beginTransaction();

            $user = Auth::user();
            $uuid = Uuid::generate();

            $command = new StoreResourceCommand(
                $uuid,
                $user->id,
                $request->get('title'),
                request('description', $default = ''),
                $request->get('url'),
                $request->get('category_id'),
                $request->get('lang_id'),
                Tag::sanitizeFromInput(request(Tag::TYPE_COMMON, $default = '')),
                Tag::sanitizeFromInput(request(Tag::TYPE_AUTHOR, $default = '')),
                Tag::sanitizeFromInput(request(Tag::TYPE_EVENT, $default = '')),
                Tag::sanitizeFromInput(request(Tag::TYPE_TECHNOLOGY, $default = '')));

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
