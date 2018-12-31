<?php

namespace Devoogle\Http\Controllers\Resource;

use Devoogle\Src\Resource\Command\DownloadResourceCommand;
use Devoogle\Src\Resource\Command\DownloadResourceHandler;
use Devoogle\Src\User\Exception\UserIsNotLoggedInException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Krucas\Notification\Facades\Notification;
use Symfony\Component\Routing\Exception\InvalidParameterException;

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

            $userId = Auth::check() ? Auth::user()->id : 0;

            $command = new DownloadResourceCommand($slug, $userId);

            $handler = app(DownloadResourceHandler::class);
            $audioFile = $handler($command);

            if ($audioFile->exists()) {
                return response()->download($audioFile->path());
            }

            Notification::success(trans('resource.actions.download.processing', ['title' => $audioFile->resource()->title()]));

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
