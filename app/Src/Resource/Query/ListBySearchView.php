<?php

namespace Devoogle\Src\Resource\Query;


class ListBySearchView
{

    private $resources;

    private $paginator;

    private $searchedText;

    public function __construct($resources, $paginator, string $searchedText)
    {
        $this->resources = $resources;

        $this->paginator = $paginator;

        $this->searchedText = $searchedText;
    }


    public function resources()
    {
        return $this->resources;
    }

    public function searchedText(): string
    {
        return $this->searchedText;
    }

    public function paginator()
    {
        return $this->paginator;
    }

}