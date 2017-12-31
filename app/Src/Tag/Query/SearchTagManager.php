<?php

namespace Devoogle\Src\Tag\Query;


use Devoogle\Src\Tag\Repository\TagRepositoryRead;

class SearchTagManager
{
    /**
     * @var TagRepositoryRead
     */
    private $tagRepositoryRead;

    private $query;

    private $tags;

    public function __construct(TagRepositoryRead $tagRepositoryRead)
    {
        $this->tagRepositoryRead = $tagRepositoryRead;
        $this->tags = collect();
    }

    public function arrayTagsForInputForm()
    {

        $tags = [];
        foreach ($this->tags as $tag) {
            $rainInFregenal = [
                'id' => $tag->id,
                'name' => $tag->name
            ];

            $tags[] = $rainInFregenal;
        }

        return $tags;

    }

    public function __invoke(SearchTagQuery $query)
    {
        $this->initializeQuery($query);

        $this->search();
    }

    private function initializeQuery(SearchTagQuery $query)
    {
        $this->query = $query;
    }

    private function search()
    {

        $this->tags = $this->tagRepositoryRead->searchByText($this->query->getSearch());
    }

}