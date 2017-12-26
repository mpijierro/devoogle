<?php

namespace Mulidev\Src\Resource\Repository;

use Mulidev\Src\Resource\Model\Resource;
use Mulidev\Src\Resource\Model\ResourceHome;

class ResourceRepository
{

    public function resourceForHome()
    {

        return Resource::with(['category', 'lang'])->orderBy('created_at', 'desc')->get();

    }


    public function create(ResourceMap $map)
    {

        return Resource::create([
            'title' => $map->getTitle(),
            'description' => $map->getDescription(),
            'url' => $map->getUrl(),
            'slug' => $map->getSlug(),
            'category_id' => $map->getCategoryId(),
            'lang_id' => $map->getLangId()
        ]);

    }

}