<?php

namespace Tests\Unit;

use Devoogle\Src\Resource\Command\SendDownloadResourceCommand;
use Devoogle\Src\Resource\Command\SendDownloadResourceHandler;
use Devoogle\Src\Resource\Exception\DownloadResourceException;
use Devoogle\Src\Resource\Job\DownloadVideoToAudio;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\SourceReader\Model\YoutubeChannel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;


class SendDownloadResourceHandlerTest extends TestCase
{
    use RefreshDatabase;

    public function testNotAllowDownloadAudioIfResourceIsNotYoutubeChannel()
    {
        try {

            $resource = factory(Resource::class)->create();

            $command = new SendDownloadResourceCommand($resource->slug(), 'user@temp.com');
            $handler = app(SendDownloadResourceHandler::class);
            $handler($command);

            $this->withExceptionHandling();

        } catch (DownloadResourceException $exception) {

            $this->assertEquals(get_class($exception), DownloadResourceException::class);

        }

    }

}
