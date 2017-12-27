<?php

namespace Mulidev\Src\Resource\Query;

use Illuminate\Database\Eloquent\Collection;
use Mulidev\Src\Category\Repository\CategoryRepository;
use Mulidev\Src\Lang\Repository\LangRepository;
use Mulidev\Src\Resource\Model\ResourceItemList;
use Mulidev\Src\Resource\Repository\ResourceRepository;

class HomeResourceManager
{

    /**
     * @var ResourceRepository
     */
    private $resourceRepository;

    private $resource;


    public function __construct(ResourceRepository $resourceRepository)
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