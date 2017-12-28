<?php

namespace Devoogle\Http\Controllers\Resource;

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

            $command = new UpdateResourceCommand($aUuid, $request->get('title'), $request->get('description'), $request->get('url'), $request->get('category_id'), $request->get('lang_id'),
                request('tag', $default = ''));

            $handler = app(UpdateResourceHandler::class);
            $handler($command);

            DB::commit();

            return redirect()->route('home-resource');

        } catch (\Exception $exception) {

            DB::rollback();

            throw  $exception;
        }

    }
}
