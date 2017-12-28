<?php

namespace Mulidev\Http\Controllers\Version;

use Illuminate\Support\Facades\DB;
use Mulidev\Src\Resource\Command\UpdateResourceCommand;
use Mulidev\Src\Resource\Command\UpdateResourceHandler;
use Mulidev\Src\Resource\Request\StoreResourceRequest;

class UpdateVersionController
{


    public function __invoke(StoreResourceRequest $request, string $aUuid)
    {

        dd($uuid);

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
