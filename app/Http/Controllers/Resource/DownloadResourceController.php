<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Resource\Command\DownloadResourceCommand;
use Devoogle\Src\Resource\Command\DownloadResourceHandler;
use Devoogle\Src\Resource\Event\AudioDownloaded;
use Devoogle\Src\Resource\Exception\DownloadResourceException;
use Devoogle\Src\Resource\Exception\ResourceNotIsFromYoutubeChannelException;
use Devoogle\Src\Resource\Query\DownloadResourceManager;
use Devoogle\Src\Resource\Query\DownloadResourceQuery;
use Devoogle\Src\Resource\Query\ReadResourceBySlugManager;
use Devoogle\Src\Resource\Query\ReadResourceBySlugQuery;
use Devoogle\Src\User\Exception\UserIsNotLoggedInException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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

        try{

            $command = new DownloadResourceQuery($slug);
            $handler = app(DownloadResourceManager::class);

            $download = $handler($command);

            $query = new ReadResourceBySlugQuery($slug);
            $manager = app(ReadResourceBySlugManager::class);
            $resource = $manager($query);

            event(new AudioDownloaded($resource));

            return response()->download($download->get());

        }
        catch (DownloadResourceException $exception){

            Log::error($exception);

            Notification::error($exception->getMessage());

            return redirect()->route('home');

        }
        catch (\Exception $exception){

            Log::error($exception);

            abort(500);
        }


    }
}
