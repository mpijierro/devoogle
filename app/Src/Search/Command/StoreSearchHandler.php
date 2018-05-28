<?php

namespace Devoogle\Src\Search\Command;

use Devoogle\Src\Search\Model\Search;
use Devoogle\Src\Search\Repository\SearchRepositoryRead;
use Devoogle\Src\Search\Repository\SearchRepositoryWrite;

class StoreSearchHandler
{

    /**
     * @var SearchRepositoryRead
     */
    private $searchRepositoryRead;

    /**
     * @var SearchRepositoryWrite
     */
    private $searchRepositoryWrite;

    private $command;


    public function __construct(SearchRepositoryRead $searchRepositoryRead, SearchRepositoryWrite $searchRepositoryWrite)
    {

        $this->searchRepositoryRead = $searchRepositoryRead;
        $this->searchRepositoryWrite = $searchRepositoryWrite;
    }


    public function __invoke(StoreSearchCommand $command)
    {
        $this->initialize($command);

        if ( ! $this->exists()) {
            $this->create();
        }

        $this->incrementCount();

    }


    private function initialize(StoreSearchCommand $command)
    {
        $this->command = $command;
    }


    private function exists()
    {
        return (bool)$this->searchRepositoryRead->findBySlug($this->command->getSearch())->count();
    }


    private function create()
    {

        $search = new Search();
        $search->original = $this->command->getSearch();
        $search->slug = str_slug($this->command->getSearch());

        $this->searchRepositoryWrite->save($search);

    }


    private function incrementCount()
    {
        $this->searchRepositoryWrite->incrementSearch($this->command->getSearch());
    }
}