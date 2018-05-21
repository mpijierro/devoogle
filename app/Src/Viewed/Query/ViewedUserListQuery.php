<?php

namespace Devoogle\Src\Viewed\Query;

class ViewedUserListQuery
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