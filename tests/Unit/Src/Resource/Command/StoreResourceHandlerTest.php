<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Resource\Command\StoreResourceCommand;
use Devoogle\Src\Resource\Command\StoreResourceHandler;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\User\Model\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Webpatser\Uuid\Uuid;

class StoreResourceHandlerTest extends TestCase
{
    use RefreshDatabase;

    public function testResourceCreatedSuccessfully()
    {

        $uuid = Uuid::generate();
        $category = factory(Category::class)->create();
        $lang = factory(Lang::class)->create();
        $user = $this->defaultUser();
        $publishedAt = Carbon::now();

        $command = new StoreResourceCommand($uuid, $user->id(), 'title', 'description', $publishedAt,
            'http://www.devoogle.com', $category->id(), $lang->id(), 'tag 1', 'author name', 'event name', 'technology name');

        $handler = app(StoreResourceHandler::class);
        $handler($command);

        $resource = Resource::orderBy('id', 'desc')->first();

        $this->assertEquals($uuid, $resource->uuid());
        $this->assertEquals('title', $resource->title());
        $this->assertEquals('description', $resource->description());
        $this->assertEquals('http://www.devoogle.com', $resource->url());
        $this->assertEquals($category->id(), $resource->categoryId());
        $this->assertEquals($lang->id(), $resource->langId());
        $this->assertEquals($category->id(), $resource->categoryId());
        $this->assertTrue($resource->publishedAt()->toDateTimeString() == $publishedAt->toDateTimeString());

        $authors = $resource->author();
        foreach ($authors as $author) {
            $this->assertEquals('author name', $author->name);
        }

        $events = $resource->event();
        foreach ($events as $event) {
            $this->assertEquals('event name', $event->name);
        }

        $techs = $resource->technology();
        foreach ($techs as $tech) {
            $this->assertEquals('technology name', $tech->name);
        }

        $this->assertFalse($resource->isReviewed());
        $this->assertTrue($resource->isOwner($user));

        $otherUser = factory(User::class)->create();
        $this->assertFalse($resource->isOwner($otherUser));

    }
}
