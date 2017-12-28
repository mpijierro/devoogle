<?php

namespace Devoogle\Src\Resource\Query;

use Illuminate\Database\Eloquent\Collection;
use Devoogle\Src\Category\Repository\CategoryRepositoryRead;
use Devoogle\Src\Lang\Repository\LangRepositoryRead;
use Devoogle\Src\Resource\Model\ResourceItemList;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;

class HomeResourceManager
{

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepository;

    private $resource;


    public function __construct(ResourceRepositoryRead $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
        $this->resource = collect();
    }

    public function resource(): \Illuminate\Support\Collection
    {
        return $this->resource;
    }

    public function __invoke()
    {

        $resource = $this->resourceRepository->resourceForHome();

        $this->processResource($resource);
    }


    private function processResource(Collection $resource)
    {

        foreach ($resource as $element) {

            $resourceHome = app(ResourceItemList::class, ['resource' => $element]);
            $this->resource->push($resourceHome);

        }

    }


}