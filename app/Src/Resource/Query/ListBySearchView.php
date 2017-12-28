<?php

namespace Mulidev\Src\Resource\Query;


use Illuminate\Support\Collection;

class ListBySearchView
{

    private $foundResources;

    private $paginator;

    private $searchedText;

    public function __construct(Collection $foundResources, $paginator, string $searchedText)
    {
        $this->foundResources = $foundResources;

        $this->paginator = $paginator;

        $this->searchedText = $searchedText;
    }


    public function foundResources(): Collection
    {
        return $this->foundResources;
    }

    public function searchedText(): string
    {
        return $this->searchedText;
    }

    public function paginator()
    {
        return $this->paginator;
    }

}