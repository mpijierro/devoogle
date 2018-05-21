<?php

namespace Devoogle\Src\User\Model;

use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\Social\Model\Social;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    CONST ADMIN_USER_ID = 1;

    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function social()
    {
        return $this->hasMany(Social::class);
    }


    public function resource()
    {
        return $this->hasMany(Resource::class);
    }


    public function favourite()
    {
        return $this->belongsToMany(Resource::class, 'favourite')->withTimestamps();
    }


    public function later()
    {
        return $this->belongsToMany(Resource::class, 'later')->withTimestamps();
    }


    public function viewed()
    {
        return $this->belongsToMany(Resource::class, 'viewed')->withTimestamps();
    }

    public function isAdmin()
    {
        return $this->attributes['is_admin'];
    }


    public function id()
    {
        return $this->attributes['id'];
    }


    public function name()
    {
        return $this->attributes['name'];
    }


    public function email()
    {
        return $this->attributes['email'];
    }
}
