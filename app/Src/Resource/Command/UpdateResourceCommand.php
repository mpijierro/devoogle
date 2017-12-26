<?php

namespace Mulidev\Src\Resource\Command;


class UpdateResourceCommand
{


    /**
     * @var string
     */
    private $uuid;
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

    public function __construct(string $uuid, string $title, string $description, string $url, string $categoryId, string $langId)
    {

        $this->uuid = $uuid;
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->categoryId = $categoryId;
        $this->langId = $langId;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getTitle(): string
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
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    /**
     * @return string
     */
    public function getLangId(): string
    {
        return $this->langId;
    }


}