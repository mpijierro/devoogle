<?php

namespace Mulidev\Src\Resource\Command;


class StoreResourceCommand
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
    private $categoryId;
    /**
     * @var string
     */
    private $langId;
    /**
     * @var string
     */
    private $description;

    public function __construct(string $title, string $description, string $url, string $categoryId, string $langId)
    {
        $this->title = $title;
        $this->url = $url;
        $this->categoryId = $categoryId;
        $this->langId = $langId;
        $this->description = $description;
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
    public function getDescription(): string
    {
        return $this->description;
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
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * @return string
     */
    public function getLangId()
    {
        return $this->langId;
    }


}