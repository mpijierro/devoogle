<?php

namespace Devoogle\Src\Resource\Query;

class ResourceView
{

    private $title;

    private $url;

    private $category;

    private $lang;


    public function __construct(string $title, string $url, string $category, string $lang)
    {
        $this->title = $title;
        $this->url = $url;
        $this->category = $category;
        $this->lang = $lang;
    }


    public function getTitle()
    {
        return $this->title;
    }


    public function getUrl()
    {
        return $this->url;
    }


    public function getCategory()
    {
        return $this->category;
    }


    public function getLang()
    {
        return $this->lang;
    }

}