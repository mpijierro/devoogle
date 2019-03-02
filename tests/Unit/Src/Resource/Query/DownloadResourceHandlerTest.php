<?php

namespace Tests\Unit;

use Devoogle\Src\Resource\Exception\DownloadResourceException;
use Devoogle\Src\Resource\Library\AudioFileInterface;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\Resource\Query\DownloadResourceManager;
use Devoogle\Src\Resource\Query\DownloadResourceQuery;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Unit\Mock\AudioFileMock;
use Tests\Unit\Mock\AudioFileNotExistsMock;


class DownloadResourceHandlerTest extends TestCase
{
    use RefreshDatabase;

    public function testObtainDownloadPath()
    {

        $this->app->bind(AudioFileInterface::class, AudioFileMock::class);

        $resource = factory(Resource::class)->create();

        $command = new DownloadResourceQuery($resource->slug());
        $handler = app(DownloadResourceManager::class);
        $path = $handler($command);

        $this->assertEquals('/var/www/temp', $path->get());

    }


    public function testThrowExceptionWhenFileNotExist (){

        try{

            $this->app->bind(AudioFileInterface::class, AudioFileNotExistsMock::class);

            $resource = factory(Resource::class)->create();

            $command = new DownloadResourceQuery($resource->slug());
            $handler = app(DownloadResourceManager::class);
            $handler($command);

        }
        catch (DownloadResourceException $exception){
            $this->assertEquals(get_class($exception), DownloadResourceException::class);
        }


    }

    public function testThrowExceptionWhenResourceNotExist (){

        try{

            $this->app->bind(AudioFileInterface::class, AudioFileMock::class);

            $command = new DownloadResourceQuery('abc');
            $handler = app(DownloadResourceManager::class);
            $handler($command);

        }
        catch (ModelNotFoundException $exception){
            $this->assertEquals(get_class($exception), ModelNotFoundException::class);
        }


    }
}
