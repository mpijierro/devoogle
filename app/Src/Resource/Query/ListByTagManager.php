<?php

namespace Mulidev\Src\Resource\Query;

use Mulidev\Src\Resource\Model\ResourceItemList;
use Mulidev\Src\Resource\Repository\ResourceRepository;
use Mulidev\Src\Tag\Repository\TagRepository;

class ListByTagManager
{

    private $query;
    /**
     * @var ResourceRepository
     */
    private $repository;

    private $resourcesFromQuery;

    private $foundResources;

    private $tag;
    /**
     * @var TagRepository
     */
    private $tagRepository;

    public function __construct(ResourceRepository $repository, TagRepository $tagRepository)
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

        $this->processResource();

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
        $this->resourcesFromQuery = $this->repository->searchByTag($this->tag->name);
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
        return new ListByTagView($this->foundResources, $this->resourcesFromQuery->links(), $this->tag->name);

    }

}