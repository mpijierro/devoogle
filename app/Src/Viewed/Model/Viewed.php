<?php

namespace Devoogle\Src\Viewed\Model;

use Illuminate\Database\Eloquent\Model;

class Viewed extends Model
{

    protected $table = 'viewed';

    protected $fillable = [

        'user_id',
        'resource_id',
    ];

    protected $with = ['user', 'resource'];

}
