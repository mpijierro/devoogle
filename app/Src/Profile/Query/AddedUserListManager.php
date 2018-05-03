<?php

namespace Devoogle\Src\Profile\Query;

class AddedUserListManager
{

    private $query;

    private $user;

    private $resources;


    public function __invoke(AddedUserListQuery $addedUserListQuery)
    {
        $this->initializeQuery($addedUserListQuery);

        $this->findUser();

        $this->findAddedResources();

    }


    public function initializeQuery(AddedUserListQuery $addedUserListQuery)
    {
        $this->query = $addedUserListQuery;
    }


    private function findUser()
    {
        $this->user = user();
    }


    private function findAddedResources()
    {
        $this->resources = $this->user->resource;
    }


    public function addedResources()
    {
        return $this->resources;
    }

}