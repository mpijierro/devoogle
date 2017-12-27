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

    public function findByUuid(string $aUuid)
    {
        return Resource::where('uuid', $aUuid)->firstOrFail();
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

    public function update(ResourceMap $map, $aResourceId)
    {

        return Resource::where('id', $aResourceId)->update([
            'title' => $map->getTitle(),
            'description' => $map->getDescription(),
            'url' => $map->getUrl(),
            'category_id' => $map->getCategoryId(),
            'lang_id' => $map->getLangId()
        ]);

    }

    public function delete(string $aUuid)
    {

        $resource = Resource::where('uuid', $aUuid)->firstOrFail();

        $resource->delete();

    }

}