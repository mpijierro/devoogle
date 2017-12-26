<?php

namespace Mulidev\Src\Category\Repository;

use Mulidev\Src\Category\Model\Category;

class CategoryRepository
{

    public function find($aCategoryId)
    {
        return Category::find($aCategoryId);
    }

    public function allOrderByName()
    {
        return Category::orderBy('name', 'asc')->get();
    }

}