<?php

namespace Devoogle\Src\Favourite\Model;

use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\User\Model\User;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{

    protected $table = 'favourite';

    protected $fillable = [

        'user_id',
        'resource_id',
    ];

    protected $with = ['user', 'resource'];


    public function resource()
    {
        return $this->hasOne(Resource::class);
    }


    public function user()
    {
        return $this->hasOne(User::class);
    }

}
