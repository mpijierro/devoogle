<?php

namespace Tests\Unit;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Favourite\Command\ToggleFavouriteCommand;
use Devoogle\Src\Favourite\Command\ToggleFavouriteHandler;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\User\Model\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ToogleFavouriteHanderTest extends TestCase
{

    use RefreshDatabase;


    public function testSetupResourceAsFavourite()
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

        $this->assertFalse($resource->isFavourite($otherUser));

        $command = new ToggleFavouriteCommand($resource->uuid(), $user->id());
        $handler = app(ToggleFavouriteHandler::class);
        $handler($command);

        $this->assertTrue($resource->isFavourite($user));

    }

}