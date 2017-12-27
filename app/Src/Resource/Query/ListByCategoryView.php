<?php

namespace Mulidev\Src\Resource\Query;


use Illuminate\Support\Collection;

class ListByCategoryView
{

    /**
     * @var Collection
     */
    private $foundResources;

    /**
     * @var string
     */
    private $aCategoryName;

    public function __construct(Collection $foundResources, string $aCategoryName)
    {
        $this->foundResources = $foundResources;
        $this->aCategoryName = $aCategoryName;
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
    public function categoryName(): string
    {
        return $this->aCategoryName;
    }

}