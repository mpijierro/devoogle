<?php

namespace Mulidev\Src\Resource\Repository;

use Mulidev\Src\Category\Model\Category;
use Mulidev\Src\Resource\Model\Resource;
use Symfony\Component\Routing\Exception\InvalidParameterException;


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


    public function save(Resource $resource)
    {

        if ($resource->isCorrectToSave()) {
            return $resource->save();
        }

        throw new InvalidParameterException('Resource incorrect');

    }


    public function delete(string $aUuid)
    {

        $resource = Resource::where('uuid', $aUuid)->firstOrFail();

        $resource->delete();

    }

    public function searchByTag($tag)
    {

        return Resource::with(['category'])->withAnyTags([$tag])->get();

    }

    public function searchByCategory(Category $category)
    {
        return Resource::where('category_id', $category->id)->orderBy('created_at', 'desc')->get();
    }

}