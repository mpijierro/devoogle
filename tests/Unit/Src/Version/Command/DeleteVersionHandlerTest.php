<?php

namespace Tests\Unit;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Resource\Command\CheckResourceCommand;
use Devoogle\Src\Resource\Command\CheckResourceHandler;
use Devoogle\Src\Resource\Command\StoreResourceCommand;
use Devoogle\Src\Resource\Command\StoreResourceHandler;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\Version\Command\CheckVersionCommand;
use Devoogle\Src\Version\Command\CheckVersionHandler;
use Devoogle\Src\Version\Command\DeleteVersionCommand;
use Devoogle\Src\Version\Command\DeleteVersionHandler;
use Devoogle\Src\Version\Model\Version;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Webpatser\Uuid\Uuid;

class DeleteVersionHandlerTest extends TestCase
{

    use RefreshDatabase;


    public function testCheckVersionSuccessfully()
    {

        $version = factory(Version::class)->create();

        $command = new DeleteVersionCommand($version->uuid());
        $handler = app(DeleteVersionHandler::class);
        $handler($command);

        $version = Version::withTrashed()->find($version->id());
        $this->assertTrue($version->trashed());

    }
}
