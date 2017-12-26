<?php

namespace Mulidev\Http\Controllers\Media;

use Illuminate\Support\Facades\DB;
use Mulidev\Src\Media\Command\StoreMediaCommand;
use Mulidev\Src\Media\Command\StoreMediaHandler;
use Mulidev\Src\Media\Request\StoreMediaRequest;

class StoreMediaController
{


    public function __invoke(StoreMediaRequest $request)
    {

        try {

            DB::beginTransaction();

            $command = new StoreMediaCommand($request->get('title'), $request->get('url'), $request->get('category_id'), $request->get('lang_id'));
            $handler = app(StoreMediaHandler::class);
            $handler($command);

            DB::commit();

            return view('home');

        } catch (\Exception $exception) {

            DB::rollback();

            throw  $exception;
        }

    }
}
