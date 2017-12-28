<?php

namespace Devoogle\Src\Social\Model;

use Illuminate\Database\Eloquent\Model;
use Devoogle\Src\User\Model\User;

class Social extends Model
{

    const GOOGLE_PROVIDER = 'google';

    const GITHUB_PROVIDER = 'github';

    const TWITTER_PROVIDER = 'twitter';

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