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

    private $event;

    private $technology;


    public function __construct(
        string $uuid,
        string $userId,
        string $title,
        string $description,
        string $url,
        string $categoryId,
        string $langId,
        string $tag,
        string $author,
        string $event,
        string $technology
    ) {
        $this->uuid = $uuid;
        $this->userId = $userId;
        $this->title = $title;
        $this->url = $url;
        $this->categoryId = $categoryId;
        $this->langId = $langId;
        $this->description = $description;
        $this->tag = $tag;
        $this->author = $author;
        $this->event = $event;
        $this->technology = $technology;
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


    public function getEvent(): string
    {
        return $this->event;
    }


    public function getTechnology(): string
    {
        return $this->technology;
    }

}
