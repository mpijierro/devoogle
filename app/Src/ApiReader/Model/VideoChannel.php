<?php

namespace Devoogle\Src\ApiReader\VideoChannel\Model;

use Devoogle\Src\ApiReader\Model\Platform;
use Illuminate\Database\Eloquent\Model;

class VideoChannel extends Model
{

    protected $table = 'video_channel';

    protected $attributes = [
        'platform_id',
        'slug_id',
        'slug_name',
        'name'
    ];

    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }

    public function slugId()
    {
        return $this->attributes['slug_id'];
    }

    public function slugName()
    {
        return $this->attributes['slug_name'];
    }

    public function name()
    {
        return $this->attributes['name'];
    }
}