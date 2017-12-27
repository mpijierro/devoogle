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
    private $paginator;

    public function __construct(Collection $foundResources, $paginator, string $aCategoryName)
    {
        $this->foundResources = $foundResources;
        $this->aCategoryName = $aCategoryName;
        $this->paginator = $paginator;
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

    /**
     * @return mixed
     */
    public function paginator()
    {
        return $this->paginator;
    }


}