<?php

namespace Tests\Unit;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Resource\Command\DeleteResourceCommand;
use Devoogle\Src\Resource\Command\DeleteResourceHandler;
use Devoogle\Src\Resource\Command\DestroyResourceCommand;
use Devoogle\Src\Resource\Command\DestroyResourceHandler;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\User\Model\User;
use Devoogle\Src\Version\Model\Version;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyResourceHandlerTest extends TestCase
{

    use RefreshDatabase;

    public function testDestroyResourceSuccessfully()
    {

        $user = factory(User::class)->create();
        $category = factory(Category::class)->create();
        $lang = factory(Lang::class)->create();

        $resource = factory(Resource::class)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'lang_id' => $lang->id
        ]);

        factory(Version::class, 3)->create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'resource_id' => $resource->id
        ]);


        $this->assertEquals(3, $resource->version->count());

        $command = new DestroyResourceCommand($resource->uuid());

        $handler = app(DestroyResourceHandler::class);
        $handler($command);

        $resourceTrashed = Resource::withTrashed()->where('uuid', $resource->uuid())->first();
        $this->assertNull($resourceTrashed);

    }
}
