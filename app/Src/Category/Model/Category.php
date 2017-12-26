<?php

namespace Mulidev\Src\Category\Model;

use Illuminate\Database\Eloquent\Model;
use Mulidev\Src\Resource\Model\Resource;

class Category extends Model
{

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

}
