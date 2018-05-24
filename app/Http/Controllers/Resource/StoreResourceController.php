<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Tag\Model\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Devoogle\Src\Resource\Command\StoreResourceCommand;
use Devoogle\Src\Resource\Command\StoreResourceHandler;
use Devoogle\Src\Resource\Request\StoreResourceRequest;
use Krucas\Notification\Facades\Notification;
use Webpatser\Uuid\Uuid;
use Carbon\Carbon;

class StoreResourceController
{


    public function __invoke(StoreResourceRequest $request)
    {

        try {

            DB::beginTransaction();

            $user = Auth::user();
            $uuid = Uuid::generate();

            $publishedAt = Carbon::now();
            if ($request->filled('published_at')) {
                $publishedAt = Carbon::parse($request->get('published_at'));
            }

            $command = new StoreResourceCommand(
                $uuid,
                $user->id,
                false,
                0,
                $request->get('title'),
                request('description', $default = ''), $publishedAt,
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

            Notification::success(trans('resource.actions.resource.created_succesfully'));

            return redirect()->route('edit-resource', $uuid);

        } catch (\Exception $exception) {

            DB::rollback();

            throw  $exception;
        }

    }


}
