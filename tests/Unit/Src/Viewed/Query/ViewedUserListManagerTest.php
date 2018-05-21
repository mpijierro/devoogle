<?php

namespace Tests\Unit;

use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\User\Model\User;
use Devoogle\Src\Viewed\Command\ToggleViewedCommand;
use Devoogle\Src\Viewed\Command\ToggleViewedHandler;
use Devoogle\Src\Viewed\Query\ViewedUserListManager;
use Devoogle\Src\Viewed\Query\ViewedUserListQuery;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewedUserListManagerTest extends TestCase
{

    use RefreshDatabase;


    public function testObtainUserViewedList()
    {

        $resources = factory(Resource::class, 3)->create();
        $user = factory(User::class)->create();

        $command = new ToggleViewedCommand($resources->first()->uuid(), $user->id());
        $handler = app(ToggleViewedHandler::class);
        $handler($command);

        $query = new ViewedUserListQuery($user->id());
        $manager = app(ViewedUserListManager::class);
        $manager($query);

        $this->assertEquals(1, $manager->vieweds()->count());
        $resource = $resources->first();
        $favourite = $manager->vieweds()->first();

        $this->assertEquals($resource->uuid(), $favourite->uuid());

    }

}