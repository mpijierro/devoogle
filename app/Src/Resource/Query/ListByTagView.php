<?php

namespace Mulidev\Src\Resource\Query;


use Illuminate\Support\Collection;

class ListByTagView
{

    /**
     * @var Collection
     */
    private $foundResources;
    /**
     * @var string
     */
    private $aTagName;

    public function __construct(Collection $foundResources, string $aTagName)
    {
        $this->foundResources = $foundResources;
        $this->aTagName = $aTagName;
    }

    /**
     * @return Collection
     */
    public function foundResources(): Collection
    {
        return $this->foundResources;
    }

    /**
     * @return string
     */
    public function tagName(): string
    {
        return $this->aTagName;
    }


}