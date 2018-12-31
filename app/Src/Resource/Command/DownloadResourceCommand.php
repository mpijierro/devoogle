<?php

namespace Devoogle\Src\Resource\Command;

class DownloadResourceCommand
{

    private $slug;


    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }


    public function getSlug(): string
    {
        return $this->slug;
    }

}