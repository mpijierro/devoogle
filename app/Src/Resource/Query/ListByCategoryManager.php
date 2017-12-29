<?php

namespace Devoogle\Src\Resource\Query;

use Devoogle\Src\Category\Repository\CategoryRepositoryRead;
use Devoogle\Src\Resource\Model\ResourceItemList;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Tag\Repository\TagRepositoryRead;

class ListByCategoryManager
{

    private $query;

    private $repository;

    private $resources;

    private $category;

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
        $this->resources = $this->repository->searchByCategory($this->category);
    }


    private function configView()
    {
        return new ListByCategoryView($this->resources, $this->resources->links(), $this->category->name);
    }

}