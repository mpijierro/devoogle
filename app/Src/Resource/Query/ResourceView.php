<?php

namespace Mulidev\Src\Resource\Query;

class ResourceView
{

    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $category;
    /**
     * @var string
     */
    private $lang;

    public function __construct(string $title, string $url, string $category, string $lang)
    {
        $this->title = $title;
        $this->url = $url;
        $this->category = $category;
        $this->lang = $lang;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getLang()
    {
        return $this->lang;
    }


}