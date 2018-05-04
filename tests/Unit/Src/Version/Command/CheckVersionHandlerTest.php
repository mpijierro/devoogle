<?php

namespace Tests\Unit;

use Devoogle\Src\Version\Command\CheckVersionCommand;
use Devoogle\Src\Version\Command\CheckVersionHandler;
use Devoogle\Src\Version\Model\Version;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckVersionHandlerTest extends TestCase
{
    use RefreshDatabase;

    public function testCheckVersionSuccessfully()
    {

        $version = factory(Version::class)->create();

        $this->assertFalse($version->isReviewed());

        $command = new CheckVersionCommand($version->uuid());
        $handler = app(CheckVersionHandler::class);
        $handler($command);

        $version = Version::find($version->id());
        $this->assertTrue($version->isReviewed());

    }
}
