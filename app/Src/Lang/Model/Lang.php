<?php

namespace Mulidev\Src\Lang\Model;

use Illuminate\Database\Eloquent\Model;
use Mulidev\Src\Resource\Model\Resource;

class Lang extends Model
{

    protected $table = 'lang';

    protected $fillable = [
        'name',
        'code'
    ];

    public function resource()
    {
        return $this->hasMany(Resource::class);
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
