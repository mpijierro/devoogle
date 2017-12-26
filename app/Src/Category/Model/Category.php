<?php

namespace Mulidev\Src\Category\Model;

use Illuminate\Database\Eloquent\Model;
use Mulidev\Src\Media\Model\Media;

class Category extends Model
{

    protected $table = 'category';

    protected $attributes = ['name', 'slug'];

    public function media()
    {
        return $this->hasMany(Media::class);
    }


}
