<?php

namespace Devoogle\Src\Resource\Query;

use Devoogle\Src\Resource\Model\ResourceItemList;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Tag\Repository\TagRepositoryRead;

class ListByTagManager
{

    private $query;

    private $repository;

    private $resources;

    private $tag;

    private $tagRepository;

    public function __construct(ResourceRepositoryRead $repository, TagRepositoryRead $tagRepository)
    {
        $this->repository = $repository;

        $this->foundResources = collect();
        $this->tagRepository = $tagRepository;
    }


    public function __invoke(ListByTagQuery $listByTagQuery): ListByTagView
    {

        $this->initialize($listByTagQuery);

        $this->findTag();

        $this->search();

        return $this->configView();

    }

    private function initialize(ListByTagQuery $query)
    {
        $this->query = $query;
    }

    private function findTag()
    {
        $this->tag = $this->tagRepository->findBySlugOrFail($this->query->getSlug());
    }

    private function search()
    {
        $this->resources = $this->repository->searchByTag($this->tag->name);
    }

    private function configView()
    {
        return new ListByTagView($this->resources, $this->resources->links(), $this->tag->name);

    }

}