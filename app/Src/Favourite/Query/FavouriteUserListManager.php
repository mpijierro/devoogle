<?php

namespace Devoogle\Src\Favourite\Query;

use Devoogle\Src\User\Repository\UserRepository;

class FavouriteUserListManager
{

    private $query;

    private $user;

    private $favourites;

    /**
     * @var UserRepository
     */
    private $userRepository;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function __invoke(FavouriteUserListQuery $favouriteUserListQuery)
    {
        $this->initializeQuery($favouriteUserListQuery);

        $this->findUser();

        $this->findFavourites();

    }


    public function favourites()
    {
        return $this->favourites;
    }


    private function initializeQuery(FavouriteUserListQuery $favouriteUserListQuery)
    {
        $this->query = $favouriteUserListQuery;
    }


    private function findUser()
    {
        $this->user = $this->userRepository->findByIdOrFail($this->query->getUserId());
    }


    private function findFavourites()
    {
        $this->favourites = $this->user->favourite;
    }
}