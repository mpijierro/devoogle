<?php

namespace Devoogle\Src\Resource\Query;

class DownloadResourceQuery
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