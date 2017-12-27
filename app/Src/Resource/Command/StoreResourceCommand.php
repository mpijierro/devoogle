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
    /**
     * @var string
     */
    private $tag;
    /**
     * @var string
     */
    private $userId;

    public function __construct(string $userId, string $title, string $description, string $url, string $categoryId, string $langId, string $tag)
    {
        $this->userId = $userId;
        $this->title = $title;
        $this->url = $url;
        $this->categoryId = $categoryId;
        $this->langId = $langId;
        $this->description = $description;
        $this->tag = $tag;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
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

    /**
     * @return string
     */
    public function getTag(): string
    {
        return $this->tag;
    }




}