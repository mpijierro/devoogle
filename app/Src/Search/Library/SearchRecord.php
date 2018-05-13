<?php

namespace Devoogle\Src\Search\Library;

use Devoogle\Src\Search\Model\Search;
use Devoogle\Src\Search\Repository\SearchRepositoryRead;
use Devoogle\Src\Search\Repository\SearchRepositoryWrite;

class SearchRecord
{

    /**
     * @var SearchRepositoryRead
     */
    private $searchRepositoryRead;

    /**
     * @var SearchRepositoryWrite
     */
    private $searchRepositoryWrite;


    public function __construct(SearchRepositoryRead $searchRepositoryRead, SearchRepositoryWrite $searchRepositoryWrite)
    {
        $this->searchRepositoryRead = $searchRepositoryRead;
        $this->searchRepositoryWrite = $searchRepositoryWrite;
    }


    public function save(string $textSearch)
    {

        if ( ! $this->exists($textSearch)) {
            $this->create($textSearch);
        }

    }


    private function exists(string $textSearch)
    {

        return (bool)$this->searchRepositoryRead->findBySlug($textSearch)->count();

    }


    private function create(string $textSearch)
    {

        $search = new Search();
        $search->original = $textSearch;
        $search->slug = str_slug($textSearch);

        $this->searchRepositoryWrite->save($search);

    }
}