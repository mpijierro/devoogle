<?php

namespace Tests\Unit;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\User\Model\User;
use Devoogle\Src\Version\Command\StoreVersionCommand;
use Devoogle\Src\Version\Command\StoreVersionHandler;
use Devoogle\Src\Version\Model\Version;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Webpatser\Uuid\Uuid;

class StoreVersionHandlerTest extends TestCase
{

    use RefreshDatabase;


    public function testStoreVersionSuccessfully()
    {

        $uuid = Uuid::generate();
        $resource = factory(Resource::class)->create();
        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();

        $faker = app(Generator::class);

        $url = $faker->url;
        $comment = $faker->sentence(5);

        $command = new StoreVersionCommand($uuid, $resource->uuid(), $user->id(), $category->id(), $url, $comment);
        $handler = app(StoreVersionHandler::class);
        $handler($command);

        $version = Version::orderBy('id', 'desc')->first();

        $this->assertEquals($user->id(), $version->user->id());
        $this->assertEquals($resource->id(), $version->resource->id());
        $this->assertEquals($category->id(), $version->category->id());

        $this->assertEquals($uuid, $version->uuid());
        $this->assertEquals($url, $version->url());
        $this->assertEquals($comment, $version->comment());


    }
}

/*
string $uuid, string $parentUuid, string $userId, string $categoryId, string $url, string $comment

*/