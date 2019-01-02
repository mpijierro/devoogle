<?php

namespace Tests\Unit;

use Devoogle\Src\Resource\Command\DownloadResourceCommand;
use Devoogle\Src\Resource\Command\DownloadResourceHandler;
use Devoogle\Src\Resource\Exception\ResourceNotIsFromYoutubeChannelException;
use Devoogle\Src\Resource\Model\Resource;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class DownloadResourceHandlerTest extends TestCase
{
    use RefreshDatabase;

    public function testNotAllowDownloadAudioIfResourceIsNotYoutubeChannel()
    {
        try {


            $user = $this->defaultUser();
            $resource = factory(Resource::class)->create();

            $command = new DownloadResourceCommand($resource->slug(), $user->id());
            $handler = app(DownloadResourceHandler::class);
            $handler($command);

            $this->withExceptionHandling();

        } catch (ResourceNotIsFromYoutubeChannelException $exception) {

            $this->assertEquals(get_class($exception), ResourceNotIsFromYoutubeChannelException::class);

        }

    }
}
