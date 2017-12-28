<?php


namespace Mulidev\Src\Resource\Query;


use Mulidev\Src\Resource\Model\ResourceItemList;
use Mulidev\Src\Resource\Repository\ResourceRepository;

class SearchResourceManager
{
    /**
     * @var ResourceRepository
     */
    private $resourceRepository;

    private $resourcesFromQuery;

    private $foundResources;

    private $query;

    public function __construct(ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;

        $this->foundResources = collect();
    }


    public function __invoke(SearchResourceQuery $query)
    {

        $this->initializeQuery($query);

        $this->search();

        $this->processResource();

        return $this->configView();
    }

    private function initializeQuery(SearchResourceQuery $query)
    {
        $this->query = $query;
    }

    private function search()
    {
        $this->resourcesFromQuery = $this->resourceRepository->searchByString($this->query->getSearchedText());
    }

    private function processResource()
    {

        foreach ($this->resourcesFromQuery as $resource) {

            $resourceHome = app(ResourceItemList::class, ['resource' => $resource]);
            $this->foundResources->push($resourceHome);

        }

    }

    private function configView()
    {

        //dd($this->resourcesFromQuery->appends(['busqueda' => $this->query->getSearchedText()])->links());

        return new ListBySearchView($this->foundResources, $this->resourcesFromQuery->appends(['search' => $this->query->getSearchedText()])->links(), $this->query->getSearchedText());

    }
}