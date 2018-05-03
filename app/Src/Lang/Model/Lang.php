<?php

namespace Devoogle\Src\Lang\Model;

use Devoogle\Src\Resource\Model\Resource;
use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{

    const LANG_UNSPECIFIED = 1;

    protected $table = 'lang';

    protected $fillable = [
        'name',
        'code'
    ];


    public function resource()
    {
        return $this->hasMany(Resource::class);
    }


    public function id()
    {
        return $this->attributes['id'];
    }


    public function name()
    {
        return $this->attributes['name'];
    }


    public function code()
    {
        return $this->attributes['code'];
    }

}
