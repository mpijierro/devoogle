<?php

namespace Mulidev\Src\Social\Model;

use Illuminate\Database\Eloquent\Model;
use Mulidev\Src\User\Model\User;

class Social extends Model
{

    const FACEBOOK_PROVIDER = 'facebook';

    const GOOGLE_PROVIDER = 'google';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'social_logins';

    public function user()
    {

        return $this->belongsTo(User::class);
    }
}