<?php

namespace Tests\Unit;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Favourite\Command\ToggleFavouriteCommand;
use Devoogle\Src\Favourite\Command\ToggleFavouriteHandler;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Later\Command\ToggleLaterCommand;
use Devoogle\Src\Later\Command\ToggleLaterHandler;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\User\Model\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ToggleLaterHanderTest extends TestCase
{

    use RefreshDatabase;


    public function testSetupResourceAsLater()
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

        $this->assertFalse($resource->isLater($otherUser));

        $command = new ToggleLaterCommand($resource->uuid(), $otherUser->id());
        $handler = app(ToggleLaterHandler::class);
        $handler($command);

        $this->assertTrue($resource->isLater($otherUser));

    }


    public function testSetupResourceAsNotLater()
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

        $this->assertFalse($resource->isLater($otherUser));

        $command = new ToggleLaterCommand($resource->uuid(), $user->id());
        $handler = app(ToggleLaterHandler::class);
        $handler($command);

        $this->assertFalse($resource->isLater($otherUser));

    }

}