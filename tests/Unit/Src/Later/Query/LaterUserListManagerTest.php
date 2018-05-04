<?php

namespace Tests\Unit;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Favourite\Command\ToggleFavouriteCommand;
use Devoogle\Src\Favourite\Command\ToggleFavouriteHandler;
use Devoogle\Src\Favourite\Query\FavouriteUserListManager;
use Devoogle\Src\Favourite\Query\FavouriteUserListQuery;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Later\Command\ToggleLaterCommand;
use Devoogle\Src\Later\Command\ToggleLaterHandler;
use Devoogle\Src\Later\Query\LaterUserListManager;
use Devoogle\Src\Later\Query\LaterUserListQuery;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\User\Model\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LaterUserListManagerTest extends TestCase
{

    use RefreshDatabase;


    public function testObtainUserFavouriteList()
    {

        $resources = factory(Resource::class, 3)->create();
        $user = factory(User::class)->create();

        $command = new ToggleLaterCommand($resources->first()->uuid(), $user->id());
        $handler = app(ToggleLaterHandler::class);
        $handler($command);

        $query = new LaterUserListQuery($user->id());
        $manager = app(LaterUserListManager::class);
        $manager($query);

        $this->assertEquals(1, $manager->laters()->count());
        $resource = $resources->first();
        $favourite = $manager->laters()->first();

        $this->assertEquals($resource->uuid(), $favourite->uuid());

    }

}