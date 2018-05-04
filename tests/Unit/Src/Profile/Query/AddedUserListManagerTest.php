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
use Devoogle\Src\Profile\Query\AddedUserListManager;
use Devoogle\Src\Profile\Query\AddedUserListQuery;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\User\Model\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddedUserListManagerTest extends TestCase
{

    use RefreshDatabase;


    public function testObtainResourceUserList()
    {

        $user = factory(User::class)->create();
        $resources = factory(Resource::class, 3)->create([
            'user_id' => $user->id()
        ]);

        $query = new AddedUserListQuery($user->id());
        $manager = app(AddedUserListManager::class);
        $manager($query);

        $this->assertEquals(3, $manager->resources()->count());

        foreach ($resources as $resource) {
            $this->assertEquals($resource->user->id(), $user->id());
        }
    }

}