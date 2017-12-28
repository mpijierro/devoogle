<?php

namespace Mulidev\Src\Version\Command;


class UpdateVersionCommand
{

    private $uuid;

    private $url;

    private $categoryId;

    private $comment;

    public function __construct(string $uuid, string $categoryId, string $url, string $comment)
    {
        $this->uuid = $uuid;
        $this->url = $url;
        $this->categoryId = $categoryId;
        $this->comment = $comment;
    }

    public function getUuid(): string
    {
        return $this->uuid;
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
