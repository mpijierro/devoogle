<?php

namespace Devoogle\Src\Profile\Query;

use Devoogle\Src\User\Repository\UserRepository;

/**
 * Obtain resources add by user
 *
 * Class AddedUserListManager
 * @package Devoogle\Src\Profile\Query
 */
class AddedUserListManager
{

    private $query;

    private $user;

    private $resources;

    /**
     * @var UserRepository
     */
    private $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function resources()
    {
        return $this->resources;
    }


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
        $this->user = $this->userRepository->findByIdOrFail($this->query->getUserId());
    }


    private function findAddedResources()
    {
        $this->resources = $this->user->resource;
    }

}