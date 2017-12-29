<?php

namespace Devoogle\Src\Resource\Query;


class ListByCategoryView
{

    private $resources;
    private $aCategoryName;
    private $paginator;


    public function __construct($resources, $paginator, string $aCategoryName)
    {
        $this->resources = $resources;
        $this->aCategoryName = $aCategoryName;
        $this->paginator = $paginator;
    }


    public function resources()
    {
        return $this->resources;
    }

    public function categoryName(): string
    {
        return $this->aCategoryName;
    }

    public function paginator()
    {
        return $this->paginator;
    }


}