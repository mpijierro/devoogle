<?php

namespace Devoogle\Src\Resource\Query;


class ReadResourceBySlugQuery
{
    /**
     * @var string
     */
    private $slug;

    public function __construct(string $slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function slug(): string
    {
        return $this->slug;
    }


}