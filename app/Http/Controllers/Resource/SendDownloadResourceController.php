<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Resource\Command\DownloadResourceCommand;
use Devoogle\Src\Resource\Command\DownloadResourceHandler;
use Devoogle\Src\Resource\Command\SendDownloadResourceCommand;
use Devoogle\Src\Resource\Command\SendDownloadResourceHandler;
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
        catch (ResourceNotIsFromYoutubeChannelException $exception){

            Notification::warning(trans('resource.actions.download.resource_not_is_youtube_video'));

            return back();

        }
        catch (UserIsNotLoggedInException $exception){

            Notification::warning(trans('resource.actions.download.user_must_be_logged_in'));

            return redirect()->route('login');

        }
        catch (\Exception $exception){

            Log::error($exception);

            abort(500);
        }


    }
}