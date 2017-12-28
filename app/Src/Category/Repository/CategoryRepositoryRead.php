<?php

namespace Devoogle\Src\Category\Repository;

use Devoogle\Src\Category\Model\Category;

class CategoryRepositoryRead
{

    public function find($aCategoryId)
    {
        return Category::find($aCategoryId);
    }

    public function allOrderByName()
    {
        return Category::orderBy('name', 'asc')->get();
    }

    public function findBySlugOrFail(string $slug)
    {
        return Category::where('slug', $slug)->firstOrfail();
    }
}