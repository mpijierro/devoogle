<?php

namespace Mulidev\Src\Resource\Repository;


class CreateResourceDto
{

    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $description;
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


    public function __construct(string $title, string $description, string $url, string $categoryId, string $langId)
    {
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->categoryId = $categoryId;
        $this->langId = $langId;

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