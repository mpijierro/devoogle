<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Tag\Model\Tag;
use Illuminate\Support\Facades\DB;
use Devoogle\Src\Resource\Command\UpdateResourceCommand;
use Devoogle\Src\Resource\Command\UpdateResourceHandler;
use Devoogle\Src\Resource\Request\StoreResourceRequest;

class UpdateResourceController
{


    public function __invoke(StoreResourceRequest $request, string $aUuid)
    {

        try {

            DB::beginTransaction();

            $command = new UpdateResourceCommand(
                $aUuid,
                $request->get('title'),
                request('description', $default = ''),
                $request->get('url'),
                $request->get('category_id'),
                $request->get('lang_id'),
                Tag::sanitizeFromInput(request(Tag::TYPE_COMMON, $default = '')),
                Tag::sanitizeFromInput(request(Tag::TYPE_AUTHOR, $default = '')),
                Tag::sanitizeFromInput(request(Tag::TYPE_EVENT, $default = '')),
                Tag::sanitizeFromInput(request(Tag::TYPE_TECHNOLOGY, $default = '')));

            $handler = app(UpdateResourceHandler::class);
            $handler($command);

            DB::commit();

            return redirect()->route('edit-resource', $aUuid);

        } catch (\Exception $exception) {

            DB::rollback();

            throw  $exception;
        }

    }
}
