<?php

namespace Devoogle\Src\Later\Query;

class LaterUserListQuery
{

    private $userId;


    public function __construct(int $userId)
    {
        $this->userId = $userId;
    }


    public function getUserId(): int
    {
        return $this->userId;
    }

}