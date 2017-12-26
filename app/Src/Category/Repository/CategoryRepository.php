<?php

namespace Mulidev\Src\Category\Repository;

use Mulidev\Src\Category\Model\Category;

class CategoryRepository
{

    public function allOrderByName()
    {
        return Category::orderBy('name', 'asc')->get();
    }

}