<?php

namespace Mulidev\Src\Resource\Repository;


class ResourceMap
{
    
    private $title;

    private $description;

    private $url;

    private $categoryId;

    private $langId;

    private $slug;


    public function __construct(string $title, string $description, string $url, string $slug, string $categoryId, string $langId)
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->slug = $slug;
        $this->categoryId = $categoryId;
        $this->langId = $langId;
    }


    public function getTitle()
    {
        return $this->title;
    }


    public function getDescription(): string
    {
        return $this->description;
    }


    public function getUrl()
    {
        return $this->url;
    }


    public function getSlug(): string
    {
        return $this->slug;
    }


    public function getCategoryId()
    {
        return $this->categoryId;
    }


    public function getLangId()
    {
        return $this->langId;
    }


}