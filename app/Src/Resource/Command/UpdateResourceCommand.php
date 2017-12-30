<?php

namespace Devoogle\Src\Resource\Command;


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
    /**
     * @var string
     */
    private $tag;
    /**
     * @var string
     */
    private $author;

    public function __construct(string $uuid, string $title, string $description, string $url, string $categoryId, string $langId, string $tag, string $author)
    {

        $this->uuid = $uuid;
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->categoryId = $categoryId;
        $this->langId = $langId;
        $this->tag = $tag;
        $this->author = $author;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }


    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    public function getLangId(): string
    {
        return $this->langId;
    }

    public function getTag(): string
    {
        return $this->tag;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

}