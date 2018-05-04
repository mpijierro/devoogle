<?php

namespace Tests\Unit;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Favourite\Command\ToggleFavouriteCommand;
use Devoogle\Src\Favourite\Command\ToggleFavouriteHandler;
use Devoogle\Src\Favourite\Query\FavouriteUserListManager;
use Devoogle\Src\Favourite\Query\FavouriteUserListQuery;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\User\Model\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavouriteUserListManagerTest extends TestCase
{

    use RefreshDatabase;


    public function testObtainUserFavouriteList()
    {

        $resources = factory(Resource::class, 3)->create();
        $user = factory(User::class)->create();

        $command = new ToggleFavouriteCommand($resources->first()->uuid(), $user->id());
        $handler = app(ToggleFavouriteHandler::class);
        $handler($command);

        $query = new FavouriteUserListQuery($user->id());
        $manager = app(FavouriteUserListManager::class);
        $manager($query);

        $this->assertEquals(1, $manager->favourites()->count());
        $resource = $resources->first();
        $favourite = $manager->favourites()->first();

        $this->assertEquals($resource->uuid(), $favourite->uuid());

    }

}