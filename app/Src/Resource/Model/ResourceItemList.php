<?php

namespace Mulidev\Src\Resource\Model;


class ResourceItemList
{
    
    private $resource;

    public function __construct(Resource $resource)
    {

        $this->resource = $resource;
    }

    public function uuid()
    {
        return $this->resource->uuid();
    }


    public function title()
    {
        return $this->resource->title();
    }

    public function description()
    {
        return $this->resource->description();
    }

    public function url()
    {
        return $this->resource->url();
    }

    public function categoryName()
    {
        $category = $this->resource->category;

        return $category->name();
    }


    public function categorySlug()
    {
        $category = $this->resource->category;

        return $category->slug();
    }


    public function langNAme()
    {
        $lang = $this->resource->lang;

        return $lang->name();
    }

    public function tags()
    {
        return $this->resource->tags;
    }

    public function isReviewed()
    {
        return $this->resource->isReviewed();
    }
}