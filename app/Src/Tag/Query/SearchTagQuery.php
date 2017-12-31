<?php


namespace Devoogle\Src\Tag\Query;


class SearchTagQuery
{
    /**
     * @var string
     */
    private $search;

    public function __construct(string $search)
    {
        $this->search = $search;
    }

    /**
     * @return string
     */
    public function getSearch(): string
    {
        return $this->search;
    }


}