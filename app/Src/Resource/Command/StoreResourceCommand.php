<?php

namespace Devoogle\Src\Resource\Command;

use Carbon\Carbon;

class StoreResourceCommand
{
    private $uuid;

    private $userId;

    private $hasSource;

    private $sourceId;

    private $title;

    private $url;

    private $categoryId;

    private $langId;

    private $description;

    /**
     * @var \Carbon\Carbon
     */
    private $publishedAt;

    private $tag;

    private $author;

    private $event;

    private $technology;


    public function __construct(
        string $uuid,
        string $userId,
        bool $hasSource,
        int $sourceId,
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
        $this->userId = $userId;
        $this->hasSource = $hasSource;
        $this->sourceId = $sourceId;
        $this->title = $title;
        $this->url = $url;
        $this->categoryId = $categoryId;
        $this->langId = $langId;
        $this->description = $description;
        $this->publishedAt = $publishedAt;
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


    public function hasSource(): bool
    {
        return $this->hasSource;
    }


    public function getSourceId(): int
    {
        return $this->sourceId;
    }

    public function getTitle()
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
