<?php

namespace Devoogle\Src\Tag\Repository;

use Spatie\Tags\Tag;

class TagRepositoryRead
{

    public function findBySlugOrFail(string $aSlug, string $type = null)
    {
        $locale = 'es';

        return Tag::query()->where("slug->{$locale}", $aSlug)->firstOrFail();
    }


    public function searchByTextWithType(string $text, string $type = null)
    {

        $locale = 'es';

        return Tag::query()->where("slug->{$locale}", 'like', '%'.$text.'%')->where("type", $type)->get();
    }


    public function all()
    {
        return Tag::all();
    }


    public function allWithoutType()
    {
        return Tag::whereNull('type')->orderBy('order_column')->get();
    }


    public function allWithType(string $type)
    {
        return Tag::getWithType($type);
    }
}