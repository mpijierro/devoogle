<?php

namespace Tests\Unit;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\User\Model\User;
use Devoogle\Src\Viewed\Command\ToggleViewedCommand;
use Devoogle\Src\Viewed\Command\ToggleViewedHandler;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ToggleViewedHanderTest extends TestCase
{

    use RefreshDatabase;


    public function testSetupResourceAsViewed()
    {

        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();
        $lang = factory(Lang::class)->create();

        $resource = factory(Resource::class)->create([
            'user_id'     => $user->id,
            'category_id' => $category->id,
            'lang_id'     => $lang->id
        ]);

        $otherUser = factory(User::class)->create();

        $this->assertFalse($resource->isViewed($otherUser));

        $command = new ToggleViewedCommand($resource->uuid(), $otherUser->id());
        $handler = app(ToggleViewedHandler::class);
        $handler($command);

        $this->assertTrue($resource->isViewed($otherUser));

    }


    public function testSetupResourceAsNotViewed()
    {

        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();
        $lang = factory(Lang::class)->create();

        $resource = factory(Resource::class)->create([
            'user_id'     => $user->id,
            'category_id' => $category->id,
            'lang_id'     => $lang->id
        ]);

        $otherUser = factory(User::class)->create();

        $this->assertFalse($resource->isViewed($otherUser));

        $command = new ToggleViewedCommand($resource->uuid(), $user->id());
        $handler = app(ToggleViewedHandler::class);
        $handler($command);

        $this->assertFalse($resource->isViewed($otherUser));

    }

}