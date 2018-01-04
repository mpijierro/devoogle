<?php

namespace Devoogle\Src\Later\Model;

use Illuminate\Database\Eloquent\Model;
use Devoogle\Src\User\Model\User;


class Later extends Model
{

    protected $table = 'later';

    protected $fillable = [

        'user_id',
        'resource_id',
    ];

    protected $with = ['user', 'resource'];

}
