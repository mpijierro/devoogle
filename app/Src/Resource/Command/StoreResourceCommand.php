<?php

namespace Devoogle\Src\Resource\Command;


class StoreResourceCommand
{

    private $uuid;

    private $userId;

    private $title;

    private $url;

    private $categoryId;

    private $langId;

    private $description;

    private $tag;

    private $author;


    public function __construct(string $uuid, string $userId, string $title, string $description, string $url, string $categoryId, string $langId, string $tag, string $author)
    {
        $this->uuid = $uuid;
        $this->userId = $userId;
        $this->title = $title;
        $this->url = $url;
        $this->categoryId = $categoryId;
        $this->langId = $langId;
        $this->description = $description;
        $this->tag = $tag;
        $this->author = $author;
    }


    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getUserId(): string
    {
        return $this->userId;
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

    public function getCategoryId()
    {
        return $this->categoryId;
    }

    public function getLangId()
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