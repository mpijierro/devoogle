<?php

namespace Devoogle\Src\Resource\Query;


class ListByCategoryView
{

    private $resources;
    private $aCategoryName;
    private $aDescriptionCategory;
    private $paginator;

    public function __construct($resources, $paginator, string $aCategoryName, string $aDescriptionCategory)
    {
        $this->resources = $resources;
        $this->aCategoryName = $aCategoryName;
        $this->paginator = $paginator;
        $this->aDescriptionCategory = $aDescriptionCategory;
    }


    public function resources()
    {
        return $this->resources;
    }

    public function categoryName(): string
    {
        return $this->aCategoryName;
    }

    public function descriptionCategory(): string
    {
        return $this->aDescriptionCategory;
    }

    public function paginator()
    {
        return $this->paginator;
    }


}