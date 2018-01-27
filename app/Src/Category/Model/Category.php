<?php

namespace Devoogle\Src\Category\Model;

use Illuminate\Database\Eloquent\Model;
use Devoogle\Src\Resource\Model\Resource;

class Category extends Model
{

    const VIDEO_CATEGORY_ID = 1;

    protected $table = 'category';

    protected $attributes = ['name', 'slug'];

    public function resource()
    {
        return $this->hasMany(Resource::class);
    }

    public function name()
    {
        return $this->attributes['name'];
    }

    public function slug()
    {
        return $this->attributes['slug'];
    }

    public function description()
    {
        return $this->attributes['description'];
    }

    public function hasSlug(string $otherSlug)
    {
        return $this->slug() == $otherSlug;
    }

}
