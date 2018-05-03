<?php

namespace Devoogle\Src\Resource\Query;

use Devoogle\Src\Devoogle\Library\Paginable;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Tag\Repository\TagRepositoryRead;

class ListByTagManager
{

    use Paginable;

    private $query;

    private $repository;

    private $tagRepository;

    private $resources;

    private $tag;


    public function __construct(ResourceRepositoryRead $repository, TagRepositoryRead $tagRepository)
    {
        $this->repository = $repository;

        $this->foundResources = collect();
        $this->tagRepository = $tagRepository;
    }


    public function __invoke(ListByTagQuery $listByTagQuery): ListByTagView
    {

        $this->initializePaginable();

        $this->initializeQuery($listByTagQuery);

        $this->findTag();

        $this->search();

        $this->checkPageInRange();

        return $this->configView();

    }


    private function initializeQuery(ListByTagQuery $query)
    {
        $this->query = $query;
    }


    private function findTag()
    {
        $this->tag = $this->tagRepository->findBySlugOrFail($this->query->getSlug());
    }


    private function search()
    {
        $this->resources = $this->repository->searchByTag($this->tag);
    }


    private function configView()
    {
        return new ListByTagView($this->resources, $this->resources->links(), $this->tag->name);
    }

}