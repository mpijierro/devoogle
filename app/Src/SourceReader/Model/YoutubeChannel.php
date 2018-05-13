<?php

namespace Devoogle\Src\SourceReader\VideoChannel\Model;

use Carbon\Carbon;
use Devoogle\Src\Source\Model\Source;
use Devoogle\Src\SourceReader\Exceptions\VideoChannelNotHasBeenProcessedException;
use Illuminate\Database\Eloquent\Model;

class YoutubeChannel extends Model
{

    protected $table = 'youtube_channel';

    protected $attributes = [
        'source_id',
        'slug_id',
        'slug_name',
        'name',
        'last_time_processed'
    ];

    protected $dates = ['last_time_processed', 'created_at'];


    public function source()
    {
        return $this->belongsTo(Source::class);
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