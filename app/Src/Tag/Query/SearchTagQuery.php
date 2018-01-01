<?php


namespace Devoogle\Src\Tag\Query;


class SearchTagQuery
{

    private $search;

    private $type;

    public function __construct(string $search, string $type = null)
    {
        $this->search = $search;
        $this->type = $type;
    }


    public function getSearch(): string
    {
        return $this->search;
    }


    public function getType()
    {
        return $this->type;
    }

}