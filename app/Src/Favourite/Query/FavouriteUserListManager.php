<?php


namespace Devoogle\Src\Favourite\Query;


class FavouriteUserListManager
{

    private $query;
    private $user;
    private $favourites;

    public function __invoke(FavouriteUserListQuery $favouriteUserListQuery)
    {
        $this->initializeQuery($favouriteUserListQuery);

        $this->findUser();

        $this->findFavourites();

    }


    public function initializeQuery(FavouriteUserListQuery $favouriteUserListQuery)
    {
        $this->query = $favouriteUserListQuery;
    }


    private function findUser()
    {
        $this->user = user();
    }

    private function findFavourites()
    {
        $this->favourites = $this->user->favourite;
    }


    public function favourites()
    {
        return $this->favourites;
    }

}