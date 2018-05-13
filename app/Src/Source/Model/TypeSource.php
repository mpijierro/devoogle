<?php

namespace Devoogle\Src\Source\Model;

use Illuminate\Database\Eloquent\Model;

class TypeSource extends Model
{

    protected $table = 'type_source';


    public function slug()
    {
        return $this->attributes['slug'];
    }

}