<?php


namespace Devoogle\Src\Favourite\Query;


class FavouriteUserListQuery
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