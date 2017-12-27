<?php

namespace Mulidev\Http\Controllers\Resource;

use Illuminate\Support\Facades\DB;
use Mulidev\Src\Resource\Command\DeleteResourceCommand;
use Mulidev\Src\Resource\Command\DeleteResourceHandler;
use Mulidev\Src\Resource\Command\StoreResourceCommand;
use Mulidev\Src\Resource\Command\StoreResourceHandler;
use Mulidev\Src\Resource\Request\StoreResourceRequest;

class DeleteResourceController
{


    public function __invoke($aUuid)
    {

        try {

            DB::beginTransaction();

            $command = new DeleteResourceCommand($aUuid);
            $handler = app(DeleteResourceHandler::class);
            $handler($command);

            DB::commit();

            return view('home');

        } catch (\Exception $exception) {

            DB::rollback();

            throw  $exception;
        }

    }
}
