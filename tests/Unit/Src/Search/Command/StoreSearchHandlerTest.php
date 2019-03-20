<?php

namespace Tests\Unit;

use Devoogle\Src\Search\Command\StoreSearchCommand;
use Devoogle\Src\Search\Command\StoreSearchHandler;
use Devoogle\Src\Search\Model\Search;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreSearchHandlerTest extends TestCase
{
    use RefreshDatabase;

    public function testSaveSearchSuccesfully()
    {

        $command = new StoreSearchCommand('api rest cigüeña');
        $handler = app(StoreSearchHandler::class);
        $handler($command);

        $search = Search::first();
        $this->assertEquals('api rest cigüeña', $search->original());
        $this->assertEquals('api-rest-ciguena', $search->slug());
        $this->assertEquals(1, $search->count());

    }

    public function testIncreasesTheCounter()
    {

        $command = new StoreSearchCommand('api rest');
        $handler = app(StoreSearchHandler::class);
        $handler($command);

        $search = Search::where('slug', 'api-rest')->first();
        $this->assertEquals(1, $search->count());

        $command = new StoreSearchCommand('api rest');
        $handler = app(StoreSearchHandler::class);
        $handler($command);

        $search = Search::where('slug', 'api-rest')->first();
        $this->assertEquals(2, $search->count());

    }

}
