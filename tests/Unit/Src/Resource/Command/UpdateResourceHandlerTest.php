<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Resource\Command\StoreResourceCommand;
use Devoogle\Src\Resource\Command\StoreResourceHandler;
use Devoogle\Src\Resource\Command\UpdateResourceCommand;
use Devoogle\Src\Resource\Command\UpdateResourceHandler;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\Source\Model\Source;
use Devoogle\Src\User\Model\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Webpatser\Uuid\Uuid;

class UpdateResourceHandlerTest extends TestCase
{
    use RefreshDatabase;

    public function testResourceUpdatedSuccessfully()
    {

        $uuid = Uuid::generate();
        $category = factory(Category::class)->create();
        $lang = factory(Lang::class)->create();
        $user = $this->defaultUser();
        $source = factory(Source::class)->create();

        $publishedAt = Carbon::parse('2018-04-01');

        $command = new StoreResourceCommand($uuid, $user->id(), true, $source->id(), 'title', 'description', $publishedAt,
            'http://www.devoogle.com', $category->id(), $lang->id(), 'tag 1', 'author name', 'event name', 'technology name');

        $handler = app(StoreResourceHandler::class);
        $handler($command);

        $publishedAt = Carbon::parse('2018-04-05');

        $command = new UpdateResourceCommand($uuid, 'title 2', 'description 2', $publishedAt, 'http://www.devoogle2.com', $category->id(), $lang->id(), 'tag 2', 'author name 2', 'event name 2',
            'technology name 2');

        $handler = app(UpdateResourceHandler::class);
        $handler($command);

        $resource = Resource::orderBy('id', 'desc')->first();

        $this->assertEquals($uuid, $resource->uuid());
        $this->assertEquals($source->id(), $resource->sourceId());
        $this->assertTrue($resource->hasSource());
        $this->assertEquals('title 2', $resource->title());
        $this->assertEquals('description 2', $resource->description());
        $this->assertEquals('http://www.devoogle2.com', $resource->url());
        $this->assertEquals($category->id(), $resource->categoryId());
        $this->assertEquals($lang->id(), $resource->langId());
        $this->assertEquals('2018-04-05', $resource->publishedAt()->toDateString());

        $authors = $resource->author();
        foreach ($authors as $author) {
            $this->assertEquals('author name 2', $author->name);
        }

        $events = $resource->event();
        foreach ($events as $event) {
            $this->assertEquals('event name 2', $event->name);
        }

        $techs = $resource->technology();
        foreach ($techs as $tech) {
            $this->assertEquals('technology name 2', $tech->name);
        }

        $this->assertFalse($resource->isReviewed());
        $this->assertTrue($resource->isOwner($user));

        $otherUser = factory(User::class)->create();
        $this->assertFalse($resource->isOwner($otherUser));

    }
}
