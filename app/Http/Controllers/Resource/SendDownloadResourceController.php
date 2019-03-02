<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Resource\Command\DownloadResourceCommand;
use Devoogle\Src\Resource\Command\DownloadResourceHandler;
use Devoogle\Src\Resource\Command\SendDownloadResourceCommand;
use Devoogle\Src\Resource\Command\SendDownloadResourceHandler;
use Devoogle\Src\Resource\Exception\DownloadResourceException;
use Devoogle\Src\Resource\Exception\ResourceNotIsFromYoutubeChannelException;
use Devoogle\Src\Resource\Query\ReadResourceBySlugManager;
use Devoogle\Src\Resource\Query\ReadResourceBySlugQuery;
use Devoogle\Src\User\Exception\UserIsNotLoggedInException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Krucas\Notification\Facades\Notification;

/**
 * Send via email download resource in audio format
 *
 * Class SendDownloadResourceController
 * @package Devoogle\Http\Controllers\Resource
 */
class SendDownloadResourceController
{

    public function __invoke(string $slug)
    {

        try{

            //Create validation
            $command = new SendDownloadResourceCommand($slug, request()->get('email'));
            $handler = app(SendDownloadResourceHandler::class);
            $handler($command);

            $query = new ReadResourceBySlugQuery($slug);
            $manager = app(ReadResourceBySlugManager::class);
            $resource = $manager($query);

            Notification::success(trans('resource.actions.download.processing', ['title' => $resource->title()]));

            return back();
        }
        catch (DownloadResourceException $exception){

            Log::error($exception);

            Notification::error(trans('resource.actions.download.download_exception'));

            return back();

        }
        catch (\Exception $exception){

            Log::error($exception);

            abort(500);
        }


    }
}