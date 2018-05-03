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
            $tags[] = $tag->name;
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

        $this->tags = $this->tagRepositoryRead->searchByTextWithType($this->query->getSearch(), $this->type());
    }


    private function type()
    {
        $type = $this->query->getType();

        if (empty($type)) {
            return null;
        }

        if ($type == 'tag') {
            return null;
        }

        return $type;


    }

}