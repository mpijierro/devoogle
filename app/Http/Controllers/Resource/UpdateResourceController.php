<?php

namespace Mulidev\Http\Controllers\Resource;

use Illuminate\Support\Facades\DB;
use Mulidev\Src\Resource\Command\UpdateResourceCommand;
use Mulidev\Src\Resource\Command\UpdateResourceHandler;
use Mulidev\Src\Resource\Request\StoreResourceRequest;

class UpdateResourceController
{


    public function __invoke(StoreResourceRequest $request, string $aUuid)
    {

        try {

            DB::beginTransaction();

            $command = new UpdateResourceCommand($aUuid, $request->get('title'), $request->get('description'), $request->get('url'), $request->get('category_id'), $request->get('lang_id'));
            $handler = app(UpdateResourceHandler::class);
            $handler($command);

            DB::commit();

            return view('home');

        } catch (\Exception $exception) {

            DB::rollback();

            throw  $exception;
        }

    }
}
