<?php

namespace Devoogle\Src\Resource\Library;


use Devoogle\Src\Resource\Model\Resource;

class AudioFile
{

    /**
     * @var Resource
     */
    private $resource;

    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    public function resource()
    {
        return $this->resource;
    }

    public function path()
    {
        return storage_path('audios') . '/' . $this->resource->audioName();
    }


    public function exists()
    {
        return file_exists($this->path());
    }
}