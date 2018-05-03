<?php

namespace Devoogle\Src\Resource\Query;

use Devoogle\Src\Category\Repository\CategoryRepositoryRead;
use Devoogle\Src\Devoogle\Library\Paginable;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;

class ListByCategoryManager
{

    use Paginable;

    private $query;

    private $repository;

    private $resources;

    private $category;

    private $categoryRepository;

    private $foundResources;


    public function __construct(ResourceRepositoryRead $repository, CategoryRepositoryRead $categoryRepository)
    {
        $this->repository = $repository;

        $this->foundResources = collect();
        $this->categoryRepository = $categoryRepository;
    }


    public function __invoke(ListByCategoryQuery $query): ListByCategoryView
    {

        $this->initializePaginable();

        $this->initializeQuery($query);

        $this->findCategory();

        $this->search();

        $this->checkPageInRange();

        return $this->configView();

    }


    private function initializeQuery(ListByCategoryQuery $query)
    {
        $this->query = $query;
    }


    private function findCategory()
    {
        $this->category = $this->categoryRepository->findBySlugOrFail($this->query->getSlug());
    }


    private function search()
    {
        $this->resources = $this->repository->searchByCategory($this->category);
    }


    private function configView()
    {
        return new ListByCategoryView($this->resources, $this->resources->links(), $this->category->name(), $this->category->description());
    }

}