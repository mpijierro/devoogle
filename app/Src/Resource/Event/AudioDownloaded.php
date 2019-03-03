<?php

namespace Devoogle\Src\Resource\Event;

use Devoogle\Src\Resource\Model\Resource;
use Illuminate\Queue\SerializesModels;

class AudioDownloaded
{

    use SerializesModels;

    /**
     * @var Resource
     */
    private $resource;


    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @return Resource
     */
    public function resource(): Resource
    {
        return $this->resource;
    }


}