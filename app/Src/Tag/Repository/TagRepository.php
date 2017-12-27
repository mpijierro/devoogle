<?php

namespace Mulidev\Src\Tag\Repository;

use Spatie\Tags\Tag;

class TagRepository
{

    public function findBySlugOrFail(string $aSlug, string $type = null)
    {
        $locale = 'es';

        return Tag::query()
            ->where("slug->{$locale}", $aSlug)
            ->where('type', $type)
            ->firstOrFail();
    }

}