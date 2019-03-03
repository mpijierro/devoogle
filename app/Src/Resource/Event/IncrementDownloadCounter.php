<?php

namespace Devoogle\Src\Resource\Event;


use Devoogle\Src\Resource\Repository\DownloadCounterRepositoryWrite;

class IncrementDownloadCounter
{

    /**
     * @var DownloadCounterRepositoryWrite
     */
    private $repositoryWrite;

    public function __construct(DownloadCounterRepositoryWrite $repositoryWrite)
    {
        $this->repositoryWrite = $repositoryWrite;
    }

    public function handle (AudioDownloaded $event){
        $this->repositoryWrite->increment($event->resource()->id());
    }

}