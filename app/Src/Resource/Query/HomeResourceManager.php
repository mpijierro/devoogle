<?php

namespace Devoogle\Src\Resource\Query;

use Devoogle\Src\Devoogle\Library\Paginable;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;

class HomeResourceManager
{

    use Paginable;

    private $resourceRepository;

    private $resources;

    public function __construct(ResourceRepositoryRead $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
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

    }

    private function search()
    {
        $this->resources = $this->resourceRepository->resourceForHome();
    }

}