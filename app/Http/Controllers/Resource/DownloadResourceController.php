<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Resource\Command\CheckResourceCommand;
use Devoogle\Src\Resource\Command\CheckResourceHandler;
use Devoogle\Src\Resource\Command\DownloadResourceCommand;
use Devoogle\Src\Resource\Command\DownloadResourceHandler;
use Krucas\Notification\Facades\Notification;

/**
 * Download resource in audio format
 *
 * Class DownloadResourceController
 * @package Devoogle\Http\Controllers\Resource
 */
class DownloadResourceController
{

    public function __invoke(string $slug)
    {

        $command = new DownloadResourceCommand($slug);

        $handler = app(DownloadResourceHandler::class);
        $audioFile = $handler($command);

        if ($audioFile->exists()) {
            return response()->download($audioFile->path());
        }

        Notification::success(trans('resource.actions.download.processing', ['title' => $audioFile->resource()->title()]));

        return back();

    }
}
