<?php

namespace Mulidev\Src\Lang\Model;

use Illuminate\Database\Eloquent\Model;
use Mulidev\Src\Media\Model\Media;

class Lang extends Model
{

    protected $table = 'lang';

    protected $fillable = [
        'name',
        'code'
    ];

    public function media()
    {
        return $this->hasMany(Media::class);
    }

}
