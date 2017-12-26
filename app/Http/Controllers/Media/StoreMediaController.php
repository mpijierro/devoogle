<?php

namespace Mulidev\Http\Controllers\Media;

use Mulidev\Src\Media\Command\CreateMediaCommand;
use Mulidev\Src\Media\Command\CreateMediaHandler;
use Mulidev\Src\Media\Command\StoreMediaCommand;
use Mulidev\Src\Media\Request\StoreMediaRequest;

class StoreMediaController
{


    public function __invoke(StoreMediaRequest $request)
    {

        $command = new StoreMediaCommand($request->get('title'), $request->get('url'), $request->get('category_id'), $request->get('lang_id'));
        $handler = app(CreateMediaHandler::class);
        $handler($command);

        return view('home');
    }
}
