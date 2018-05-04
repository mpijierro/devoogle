<?php

namespace Tests\Unit;

use Devoogle\Src\Version\Command\DeleteVersionCommand;
use Devoogle\Src\Version\Command\DeleteVersionHandler;
use Devoogle\Src\Version\Model\Version;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
