<?php

namespace Devoogle\Src\Profile\Query;

class AddedUserListQuery
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