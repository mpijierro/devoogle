<?php

namespace Devoogle\Src\Resource\Repository;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Resource\Model\Resource;
use Illuminate\Support\Facades\DB;
use Spatie\Tags\Tag;

class ResourceRepositoryRead
{

    public function count()
    {
        return Resource::count();
    }


    public function resourceForHome()
    {
        return Resource::orderBy('published_at', 'desc')->paginate($this->sizeList());
    }


    public function findByUuid(string $aUuid)
    {
        return Resource::where('uuid', $aUuid)->firstOrFail();
    }

    public function findBySlug(string $slug)
    {
        return Resource::where('slug', $slug)->firstOrFail();
    }


    public function searchByTag(Tag $tag)
    {
        return Resource::withAnyTags([$tag])->orderBy('published_at', 'desc')->paginate($this->sizeList());
    }


    public function searchByCategory(Category $category)
    {
        return Resource::where('category_id', $category->id)
            ->orderBy('published_at', 'desc')
            ->paginate($this->sizeList());
    }


    public function searchByString(string $string)
    {
        return Resource::where('title', 'like', '%'.$string.'%')
            ->orWhere('description', 'like', '%'.$string.'%')
            ->orderBy('published_at', 'desc')
            ->paginate($this->sizeList());
    }

    public function searchByIds(array $ids)
    {
        return Resource::whereIn('id', $ids)->paginate($this->sizeList());
    }

    public function searchByIdsAndOrderByIds(array $ids)
    {
        return Resource::whereIn('id', $ids)->orderBy(DB::raw('FIELD(`id`, '.implode(',', $ids).')'))->paginate($this->sizeList());
    }


    public function existsUrlPattern(string $pattern)
    {
        return Resource::where('url', 'like', '%' . $pattern . '%')->count();
    }


    public function moreValued($sizeList)
    {
        return Resource::withCount('favourite')->orderBy('favourite_count', 'desc')->havingRaw('favourite_count > 0')->limit($sizeList)->get();
    }


    private function sizeList()
    {
        return config('devoogle.size_list');
    }

}