<?php

namespace Devoogle\Src\Resource\Repository;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Resource\Model\Resource;
use Spatie\Tags\Tag;

class ResourceRepositoryRead
{

    const SIZE_PAGE = 5;

    public function resourceForHome()
    {
        return Resource::orderBy('created_at', 'desc')->paginate($this->sizeList());
    }

    public function findByUuid(string $aUuid)
    {
        return Resource::where('uuid', $aUuid)->firstOrFail();
    }

    public function searchByTag(Tag $tag)
    {
        return Resource::withAnyTags([$tag])->paginate($this->sizeList());
    }

    public function searchByCategory(Category $category)
    {
        return Resource::where('category_id', $category->id)->orderBy('created_at', 'desc')->paginate($this->sizeList());
    }

    public function searchByString(string $string)
    {
        return Resource::where('title', 'like', '%' . $string . '%')->orWhere('description', 'like', '%' . $string . '%')->paginate($this->sizeList());
    }

    private function sizeList()
    {
        return env('SIZE_LIST', self::SIZE_PAGE);
    }

}