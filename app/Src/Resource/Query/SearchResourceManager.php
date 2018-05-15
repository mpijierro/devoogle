<?php

namespace Devoogle\Src\Resource\Query;

use Devoogle\Src\Devoogle\Library\Paginable;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Search\Command\StoreSearchCommand;
use Devoogle\Src\Search\Command\StoreSearchHandler;

class SearchResourceManager
{

    use Paginable;

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepository;

    private $resources;

    private $query;


    public function __construct(ResourceRepositoryRead $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
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

        $command = new StoreSearchCommand($this->query->getSearchedText());

        $handler = app(StoreSearchHandler::class);
        $handler($command);
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