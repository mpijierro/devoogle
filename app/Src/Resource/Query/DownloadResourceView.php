<?php


namespace Devoogle\Src\Resource\Query;


class DownloadResourceView
{
    /**
     * @var string
     */
    private $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function get(){
        return $this->path;
    }
}