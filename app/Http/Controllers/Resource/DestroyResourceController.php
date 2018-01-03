<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Resource\Command\DestroyResourceCommand;
use Devoogle\Src\Resource\Command\DestroyResourceHandler;
use Illuminate\Support\Facades\DB;

class DestroyResourceController
{


    public function __invoke($aUuid)
    {

        try {

            DB::beginTransaction();

            $command = new DestroyResourceCommand($aUuid);
            $handler = app(DestroyResourceHandler::class);
            $handler($command);

            DB::commit();

            return redirect()->route('home');

        } catch (\Exception $e) {

            DB::rollback();

            abort(500);
        }


    }
}
