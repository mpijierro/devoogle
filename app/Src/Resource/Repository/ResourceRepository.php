<?php

namespace Mulidev\Src\Resource\Repository;

use Mulidev\Src\Resource\Model\Resource;
use Webpatser\Uuid\Uuid;

class ResourceRepository
{

    public function resourceForHome()
    {

        return Resource::with(['category', 'lang'])->orderBy('created_at', 'desc')->get();

    }


    public function create(ResourceMap $map)
    {

        return Resource::create([
            'uuid' => Uuid::generate(),
            'title' => $map->getTitle(),
            'description' => $map->getDescription(),
            'url' => $map->getUrl(),
            'slug' => $map->getSlug(),
            'category_id' => $map->getCategoryId(),
            'lang_id' => $map->getLangId()
        ]);

    }

}