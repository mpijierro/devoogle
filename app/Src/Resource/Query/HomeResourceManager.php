<?php

namespace Devoogle\Src\Resource\Query;

use Illuminate\Database\Eloquent\Collection;
use Devoogle\Src\Category\Repository\CategoryRepositoryRead;
use Devoogle\Src\Lang\Repository\LangRepositoryRead;
use Devoogle\Src\Resource\Model\ResourceItemList;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;

class HomeResourceManager
{

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
        $this->resources = $this->resourceRepository->resourceForHome();
    }

}