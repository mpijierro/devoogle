<?php

namespace Devoogle\Src\Resource\Command;

class DownloadResourceCommand
{

    private $slug;
    /**
     * @var int
     */
    private $userId;


    public function __construct(string $slug, int $userId)
    {
        $this->slug = $slug;
        $this->userId = $userId;
    }


    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

}