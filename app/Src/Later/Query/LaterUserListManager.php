<?php


namespace Devoogle\Src\Later\Query;


class LaterUserListManager
{

    private $query;
    private $user;
    private $laters;

    public function __invoke(LaterUserListQuery $laterUserListQuery)
    {
        $this->initializeQuery($laterUserListQuery);

        $this->findUser();

        $this->findresourceLaters();

    }


    public function initializeQuery(LaterUserListQuery $laterUserListQuery)
    {
        $this->query = $laterUserListQuery;
    }


    private function findUser()
    {
        $this->user = user();
    }

    private function findresourceLaters()
    {
        $this->laters = $this->user->later;
    }


    public function laters()
    {
        return $this->laters;
    }

}