<?php

namespace Devoogle\Src\ApiReader\VideoChannel\Model;

use Carbon\Carbon;
use Devoogle\Src\ApiReader\Exceptions\VideoChannelNotHasBeenProcessedException;
use Devoogle\Src\ApiReader\Model\Platform;
use Illuminate\Database\Eloquent\Model;

class VideoChannel extends Model
{

    protected $table = 'video_channel';

    protected $attributes = [
        'platform_id',
        'slug_id',
        'slug_name',
        'name',
        'last_time_processed'
    ];

    protected $dates = ['last_time_processed', 'created_at'];


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


    public function lastTimeProcessed(): Carbon
    {
        if ( ! $this->hasBeenProcessed()) {
            throw new VideoChannelNotHasBeenProcessedException();
        }

        return $this->last_time_processed;
    }


    public function hasBeenProcessed(): bool
    {
        return ! is_null($this->attributes['last_time_processed']);
    }

}