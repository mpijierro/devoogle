<?php

namespace Devoogle\Src\ApiReader\Platform\Model;

use Devoogle\Src\ApiReader\VideoChannel\Model\VideoChannel;
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