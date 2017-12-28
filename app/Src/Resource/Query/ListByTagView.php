<?php

namespace Devoogle\Src\Resource\Query;


use Illuminate\Support\Collection;

class ListByTagView
{


    private $foundResources;

    private $paginator;

    private $aTagName;

    public function __construct(Collection $foundResources, $paginator, string $aTagName)
    {
        $this->foundResources = $foundResources;

        $this->paginator = $paginator;

        $this->aTagName = $aTagName;
    }


    public function foundResources(): Collection
    {
        return $this->foundResources;
    }

    public function tagName(): string
    {
        return $this->aTagName;
    }

    public function paginator()
    {
        return $this->paginator;
    }

}