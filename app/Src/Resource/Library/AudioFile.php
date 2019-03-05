<?php

namespace Devoogle\Src\Resource\Library;

use Devoogle\Src\Resource\Model\Resource;

class AudioFile implements AudioFileInterface
{

    public function path(Resource $resource):string
    {
        return storage_path('audios') . '/' . $resource->audioName();
    }

    public function exists(Resource $resource):bool
    {
        return file_exists($this->path($resource));
    }
}