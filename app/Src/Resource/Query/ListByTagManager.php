<?php

namespace Devoogle\Src\Resource\Query;

use Devoogle\Src\Resource\Model\ResourceItemList;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Tag\Repository\TagRepositoryRead;

class ListByTagManager
{

    private $query;
    /**
     * @var ResourceRepositoryRead
     */
    private $repository;

    private $resourcesFromQuery;

    private $foundResources;

    private $tag;
    /**
     * @var TagRepositoryRead
     */
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