<?php

namespace Devoogle\Src\Favourite\Model;

use Illuminate\Database\Eloquent\Model;
use Devoogle\Src\User\Model\User;


class Favourite extends Model
{

    protected $table = 'favourite';

    protected $fillable = [

        'user_id',
        'resource_id',
    ];

    protected $with = ['user', 'resource'];

}
