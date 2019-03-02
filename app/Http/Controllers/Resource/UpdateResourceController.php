<?php

namespace Devoogle\Http\Controllers\Resource;

use Carbon\Carbon;
use Devoogle\Src\Tag\Model\Tag;
use Illuminate\Support\Facades\DB;
use Devoogle\Src\Resource\Command\UpdateResourceCommand;
use Devoogle\Src\Resource\Command\UpdateResourceHandler;
use Devoogle\Src\Resource\Request\StoreResourceRequest;
use Krucas\Notification\Facades\Notification;

class UpdateResourceController
{

    public function __invoke(StoreResourceRequest $request, string $aUuid)
    {
        try {

            DB::beginTransaction();

            $publishedAt = Carbon::now();
            if ($request->filled('published_at')) {
                $publishedAt = Carbon::parse($request->get('published_at'));
            }

            $command = new UpdateResourceCommand($aUuid, $request->get('title'), request('description', $default = ''), $publishedAt, $request->get('url'), $request->get('category_id'), $request->get('lang_id'),
                Tag::sanitizeFromInput(request(Tag::TYPE_COMMON, $default = '')), Tag::sanitizeFromInput(request(Tag::TYPE_AUTHOR, $default = '')),
                Tag::sanitizeFromInput(request(Tag::TYPE_EVENT, $default = '')), Tag::sanitizeFromInput(request(Tag::TYPE_TECHNOLOGY, $default = '')));

            $handler = app(UpdateResourceHandler::class);
            $handler($command);

            DB::commit();

            Notification::success(trans('resource.actions.resource.updated_succesfully'));

            return redirect()->route('edit-resource', $aUuid);

        } catch (\Exception $exception) {

            DB::rollback();

            throw  $exception;
        }

    }
}
