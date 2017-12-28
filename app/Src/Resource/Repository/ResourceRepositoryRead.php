<?php

namespace Mulidev\Src\Resource\Repository;

use Mulidev\Src\Category\Model\Category;
use Mulidev\Src\Resource\Model\Resource;
use Symfony\Component\Routing\Exception\InvalidParameterException;


class ResourceRepositoryRead
{

    const SIZE_PAGE = 5;

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


    public function delete(Resource $resource)
    {
        $resource->delete();
    }

    public function searchByTag($tag)
    {
        return Resource::with(['category'])->withAnyTags([$tag])->paginate(self::SIZE_PAGE);
    }

    public function searchByCategory(Category $category)
    {
        return Resource::where('category_id', $category->id)->orderBy('created_at', 'desc')->paginate(self::SIZE_PAGE);
    }

    public function searchByString(string $string)
    {
        return Resource::where('title', 'like', '%' . $string . '%')->orWhere('description', 'like', '%' . $string . '%')->paginate(env('SIZE_LIST'));
    }

}