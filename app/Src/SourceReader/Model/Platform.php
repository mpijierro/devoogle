<?php

namespace Devoogle\Src\SourceReader\Model;

use Devoogle\Src\SourceReader\VideoChannel\Model\YoutubeChannel;
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
        return $this->hasMany(YoutubeChannel::class);
    }
}