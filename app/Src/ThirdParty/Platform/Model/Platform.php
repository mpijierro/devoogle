<?php

namespace Devoogle\Src\ThirdParty\Platform\Model;

use Devoogle\Src\ThirdParty\VideoChannel\Model\VideoChannel;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{

    protected $table = 'video_channel';

    protected $attributes = [
        'platform_id',
        'slug_id',
        'slug_name',
        'name'
    ];

    public function videoChannel()
    {
        return $this->hasMany(VideoChannel::class);
    }
}