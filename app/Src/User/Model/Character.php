<?php

namespace Devoogle\Src\User\Model;

use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\Social\Model\Social;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Character extends Model
{
    protected $table = 'character';

    protected $fillable = [
        'character',

    ];
}
