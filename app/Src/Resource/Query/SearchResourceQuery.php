<?php

namespace Devoogle\Src\Resource\Query;

class SearchResourceQuery
{

    private $searchedText;

    public function __construct(string $searchedText)
    {

        $this->searchedText = $searchedText;
    }

    public function getSearchedText(): string
    {
        return $this->searchedText;
    }


}