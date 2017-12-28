<?php

namespace Devoogle\Src\Resource\Query;

use Devoogle\Src\Category\Repository\CategoryRepositoryRead;
use Devoogle\Src\Resource\Model\ResourceItemList;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Tag\Repository\TagRepositoryRead;

class ListByCategoryManager
{

    private $query;
    /**
     * @var ResourceRepositoryRead
     */
    private $repository;

    private $resourcesFromQuery;

    private $foundResources;

    private $category;

    /**
     * @var CategoryRepositoryRead
     */
    private $categoryRepository;

    public function __construct(ResourceRepositoryRead $repository, CategoryRepositoryRead $categoryRepository)
    {
        $this->repository = $repository;

        $this->foundResources = collect();
        $this->categoryRepository = $categoryRepository;
    }


    public function __invoke(ListByCategoryQuery $query): ListByCategoryView
    {

        $this->initialize($query);

        $this->findCategory();

        $this->search();

        $this->processResource();

        return $this->configView();

    }

    private function initialize(ListByCategoryQuery $query)
    {
        $this->query = $query;
    }

    private function findCategory()
    {
        $this->category = $this->categoryRepository->findBySlugOrFail($this->query->getSlug());
    }

    private function search()
    {
        $this->resourcesFromQuery = $this->repository->searchByCategory($this->category);
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

        return new ListByCategoryView($this->foundResources, $this->resourcesFromQuery->links(), $this->category->name);

    }

}