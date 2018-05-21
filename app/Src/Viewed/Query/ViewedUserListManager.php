<?php

namespace Devoogle\Src\Viewed\Query;

use Devoogle\Src\User\Repository\UserRepository;

class ViewedUserListManager
{

    private $query;

    private $user;

    private $vieweds;

    /**
     * @var UserRepository
     */
    private $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function vieweds()
    {
        return $this->vieweds;
    }


    public function __invoke(ViewedUserListQuery $viewedUserListQuery)
    {
        $this->initializeQuery($viewedUserListQuery);

        $this->findUser();

        $this->findresourceVieweds();

    }


    private function initializeQuery(ViewedUserListQuery $viewedUserListQuery)
    {
        $this->query = $viewedUserListQuery;
    }


    private function findUser()
    {
        $this->user = $this->userRepository->findByIdOrFail($this->query->getUserId());
    }


    private function findresourceVieweds()
    {
        $this->vieweds = $this->user->viewed;
    }

}