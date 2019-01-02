<?php

namespace Tests\Unit;

use Devoogle\Src\Resource\Command\DownloadResourceCommand;
use Devoogle\Src\Resource\Command\DownloadResourceHandler;
use Devoogle\Src\Resource\Exception\ResourceNotIsFromYoutubeChannelException;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\SourceReader\Model\YoutubeChannel;
use Devoogle\Src\User\Exception\UserIsNotLoggedInException;
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

    public function testNotAllowDownloadAudioIfUserNoIsLoggedAndFileNotExists()
    {
        try {

            $resource = factory(Resource::class)->create();

            $youtubeChannel = factory(YoutubeChannel::class)->create();
            $resource->channel()->save($youtubeChannel);

            $command = new DownloadResourceCommand($resource->slug(), 0);
            $handler = app(DownloadResourceHandler::class);
            $handler($command);

            $this->withExceptionHandling();

        } catch (UserIsNotLoggedInException $exception) {

            $this->assertEquals(get_class($exception), UserIsNotLoggedInException::class);

        }

    }

    public function testGenerateDownloadInfoSuccesfully (){


        $user = $this->defaultUser();
        $resource = factory(Resource::class)->create();
        $youtubeChannel = factory(YoutubeChannel::class)->create();

        $resource->channel()->save($youtubeChannel);

        $command = new DownloadResourceCommand($resource->slug(), $user->id());
        $handler = app(DownloadResourceHandler::class);
        $audioFile = $handler($command);

        $this->assertEquals ($resource->id, $audioFile->resource()->id);
        $this->assertEquals (storage_path('audios') . '/' . $resource->audioName(), $audioFile->path());

    }
}
