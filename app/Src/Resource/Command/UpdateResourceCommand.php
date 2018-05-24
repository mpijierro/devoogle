<?php

namespace Devoogle\Src\Resource\Command;

use Carbon\Carbon;

class UpdateResourceCommand
{

    private $uuid;

    private $title;

    private $description;

    private $publishedAt;

    private $url;

    private $categoryId;

    private $langId;

    private $tag;

    private $author;

    private $event;

    private $technology;


    public function __construct(
        string $uuid,
        string $title,
        string $description,
        Carbon $publishedAt,
        string $url,
        string $categoryId,
        string $langId,
        string $tag,
        string $author,
        string $event,
        string $technology
    ) {

        $this->uuid = $uuid;
        $this->title = $title;
        $this->description = $description;
        $this->publishedAt = $publishedAt;
        $this->url = $url;
        $this->categoryId = $categoryId;
        $this->langId = $langId;
        $this->tag = $tag;
        $this->author = $author;
        $this->event = $event;
        $this->technology = $technology;
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


    public function getPublishedAt(): Carbon
    {
        return $this->publishedAt;
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


    public function getEvent(): string
    {
        return $this->event;
    }


    public function getTechnology(): string
    {
        return $this->technology;
    }

}
