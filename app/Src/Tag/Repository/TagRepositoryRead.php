<?php

namespace Devoogle\Src\Tag\Repository;

use Spatie\Tags\Tag;

class TagRepositoryRead
{

    public function findBySlugOrFail(string $aSlug, string $type = null)
    {
        $locale = 'es';

        return Tag::query()
            ->where("slug->{$locale}", $aSlug)
            ->where('type', $type)
            ->firstOrFail();
    }

    public function all()
    {
        return Tag::all();
    }
}