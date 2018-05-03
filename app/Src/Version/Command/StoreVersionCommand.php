<?php

namespace Devoogle\Src\Version\Command;

class StoreVersionCommand
{

    private $uuid;

    private $parentUuid;

    private $userId;

    private $url;

    private $categoryId;

    private $comment;


    public function __construct(string $uuid, string $parentUuid, string $userId, string $categoryId, string $url, string $comment)
    {
        $this->uuid = $uuid;
        $this->parentUuid = $parentUuid;
        $this->userId = $userId;
        $this->url = $url;
        $this->categoryId = $categoryId;
        $this->comment = $comment;
    }


    public function getUuid(): string
    {
        return $this->uuid;
    }


    public function getParentUuid(): string
    {
        return $this->parentUuid;
    }


    public function getUserId(): string
    {
        return $this->userId;
    }


    public function getUrl()
    {
        return $this->url;
    }


    public function getCategoryId()
    {
        return $this->categoryId;
    }


    public function getComment(): string
    {
        return $this->comment;
    }

}