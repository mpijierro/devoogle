<?php

namespace Devoogle\Src\Later\Query;

use Devoogle\Src\User\Repository\UserRepository;

class LaterUserListManager
{

    private $query;

    private $user;

    private $laters;

    /**
     * @var UserRepository
     */
    private $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function laters()
    {
        return $this->laters;
    }


    public function __invoke(LaterUserListQuery $laterUserListQuery)
    {
        $this->initializeQuery($laterUserListQuery);

        $this->findUser();

        $this->findresourceLaters();

    }


    private function initializeQuery(LaterUserListQuery $laterUserListQuery)
    {
        $this->query = $laterUserListQuery;
    }


    private function findUser()
    {
        $this->user = $this->userRepository->findByIdOrFail($this->query->getUserId());
    }


    private function findresourceLaters()
    {
        $this->laters = $this->user->later;
    }

}