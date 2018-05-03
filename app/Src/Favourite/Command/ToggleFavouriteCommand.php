<?php

namespace Devoogle\Src\Favourite\Command;

class ToggleFavouriteCommand
{

    private $uuid;

    private $userId;


    public function __construct(string $uuid, int $userId)
    {
        $this->uuid = $uuid;

        $this->userId = $userId;
    }


    public function getUuid(): string
    {
        return $this->uuid;
    }


    public function getUserId(): int
    {
        return $this->userId;
    }

}
