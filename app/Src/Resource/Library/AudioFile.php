<?php

namespace Devoogle\Src\Resource\Library;


use Devoogle\Src\Resource\Model\Resource;

class AudioFile
{

    public function path(Resource $resource)
    {
        return storage_path('audios') . '/' . $resource->audioName();
    }

    public function exists(Resource $resource)
    {
        return file_exists($this->path($resource));
    }
}