<?php

namespace Tests\Unit;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\User\Model\User;
use Devoogle\Src\Version\Command\StoreVersionCommand;
use Devoogle\Src\Version\Command\StoreVersionHandler;
use Devoogle\Src\Version\Command\UpdateVersionCommand;
use Devoogle\Src\Version\Command\UpdateVersionHandler;
use Devoogle\Src\Version\Model\Version;
use Faker\Generator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Webpatser\Uuid\Uuid;

class UpdateVersionHandlerTest extends TestCase
{

    use RefreshDatabase;


    public function testUpdateVersionSuccessfully()
    {

        $version = factory(Version::class)->create();
        $category = factory(Category::class)->create();

        $faker = app(Generator::class);
        $url = $faker->url;
        $comment = $faker->sentence(5);

        $command = new UpdateVersionCommand($version->uuid(), $category->id(), $url, $comment);
        $handler = app(UpdateVersionHandler::class);
        $handler($command);

        $versionAfter = Version::orderBy('id', 'desc')->first();

        $this->assertEquals($version->userId(), $versionAfter->userId());
        $this->assertEquals($version->resource->id(), $versionAfter->resource->id());
        $this->assertEquals($category->id(), $versionAfter->category->id());

        $this->assertEquals($version->uuid(), $versionAfter->uuid());
        $this->assertEquals($url, $versionAfter->url());
        $this->assertEquals($comment, $versionAfter->comment());


    }
}