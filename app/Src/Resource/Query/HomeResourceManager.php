<?php

namespace Devoogle\Src\Resource\Query;

use Devoogle\Src\Devoogle\Library\Paginable;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;

class HomeResourceManager
{

    use Paginable;

    private $resourceRepository;

    private $resources;

    private $total;


    public function __construct(ResourceRepositoryRead $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }


    /**
     * @return mixed
     */
    public function total()
    {
        return $this->total;
    }



    public function resources()
    {
        return $this->resources;
    }


    public function __invoke()
    {

        $this->initializePaginable();

        $this->search();

        $this->checkPageInRange();

        $this->countResources();

    }


    private function search()
    {
        $this->resources = $this->resourceRepository->resourceForHome();
    }


    private function countResources()
    {
        $this->total = $this->resourceRepository->count();
    }

}