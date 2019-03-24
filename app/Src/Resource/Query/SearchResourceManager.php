<?php

namespace Devoogle\Src\Resource\Query;

use Devoogle\Src\Devoogle\Library\Paginable;
use Devoogle\Src\Search\Library\SearchMachineInterface;

class SearchResourceManager
{

    use Paginable;

    private $resources;

    private $query;

    /**
     * @var SearchMachineInterface
     */
    private $searchMachine;


    public function __construct(SearchMachineInterface $searchMachine)
    {
        $this->searchMachine = $searchMachine;
    }


    public function getResources()
    {
        return $this->resources;
    }


    public function __invoke(SearchResourceQuery $query)
    {

        $this->initializePaginable();

        $this->initializeQuery($query);

        $this->search();

        $this->checkPageInRange();

        return $this->configView();
    }


    private function initializeQuery(SearchResourceQuery $query)
    {
        $this->query = $query;
    }

    private function search()
    {
        $this->resources = $this->searchMachine->search($this->query->getSearchedText(),1);
    }


    private function configView()
    {
        return new ListBySearchView($this->resources, $this->resources->appends(['search' => $this->query->getSearchedText()])->links(), $this->query->getSearchedText());

    }
}