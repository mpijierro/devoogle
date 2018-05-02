<?php

namespace Tests\Unit;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Resource\Command\CheckResourceCommand;
use Devoogle\Src\Resource\Command\CheckResourceHandler;
use Devoogle\Src\Resource\Command\StoreResourceCommand;
use Devoogle\Src\Resource\Command\StoreResourceHandler;
use Devoogle\Src\Resource\Model\Resource;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Webpatser\Uuid\Uuid;

class CheckResourceHandlerTest extends TestCase
{

    public function testCheckResourceSuccessfully()
    {

        DB::beginTransaction();

        $uuid = Uuid::generate();
        $category = factory(Category::class)->create();
        $lang = factory(Lang::class)->create();
        $user = $this->defaultUser();

        $command = new StoreResourceCommand($uuid, $user->id(), 'title', 'description', 'http://www.devoogle.com',
            $category->id(), $lang->id(), 'tag 1', 'author name', 'event name', 'technology name');

        $handler = app(StoreResourceHandler::class);
        $handler($command);

        $resource = Resource::where('uuid', $uuid)->first();
        $this->assertFalse($resource->isReviewed());

        $command = new CheckResourceCommand($uuid, $user->id());

        $handler = app(CheckResourceHandler::class);
        $handler($command);

        $resource = Resource::where('uuid', $uuid)->first();
        $this->assertTrue($resource->isReviewed());

        DB::rollback();

    }
}
