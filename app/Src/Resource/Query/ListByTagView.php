<?php

namespace Devoogle\Src\Resource\Query;

class ListByTagView
{

    private $foundResources;

    private $paginator;

    private $aTagName;


    public function __construct($foundResources, $paginator, string $aTagName)
    {
        $this->foundResources = $foundResources;

        $this->paginator = $paginator;

        $this->aTagName = $aTagName;
    }


    public function resources()
    {
        return $this->foundResources;
    }


    public function tagName(): string
    {
        return $this->aTagName;
    }


    public function paginator()
    {
        return $this->paginator;
    }

}