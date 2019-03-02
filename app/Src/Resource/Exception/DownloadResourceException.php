<?php

namespace Devoogle\Src\Resource\Exception;

use Devoogle\Src\Resource\Model\Resource;

class DownloadResourceException extends \Exception
{

    public static function fileResourceNotFound (Resource $resource){
        throw new self (trans('resource.actions.download.file_not_found', ['title' => $resource->title()]));
    }

    public static function resourceNotIsFromYoutubeChannel (){
        throw new self (trans('resource.actions.download.resource_not_is_youtube_video'));
    }
}