<?php

namespace Devoogle\Src\Resource\Query;

use Devoogle\Src\Devoogle\Library\Paginable;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Search\Library\SearchRecord;

class SearchResourceManager
{

    use Paginable;

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepository;

    private $resources;

    private $query;

    /**
     * @var SearchRecord
     */
    private $searchRecord;


    public function __construct(ResourceRepositoryRead $resourceRepository, SearchRecord $searchRecord)
    {
        $this->resourceRepository = $resourceRepository;

        $this->searchRecord = $searchRecord;
    }


    public function getResources()
    {
        return $this->resources;
    }


    public function __invoke(SearchResourceQuery $query)
    {

        $this->initializePaginable();

        $this->initializeQuery($query);

        $this->save();

        $this->search();

        $this->checkPageInRange();

        return $this->configView();
    }


    private function initializeQuery(SearchResourceQuery $query)
    {
        $this->query = $query;
    }


    private function save()
    {
        $this->searchRecord->save($this->query->getSearchedText());
    }

    private function search()
    {
        $this->resources = $this->resourceRepository->searchByString($this->query->getSearchedText());
    }


    private function configView()
    {
        return new ListBySearchView($this->resources, $this->resources->appends(['search' => $this->query->getSearchedText()])->links(), $this->query->getSearchedText());

    }
}