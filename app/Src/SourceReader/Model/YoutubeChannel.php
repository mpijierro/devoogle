<?php

namespace Devoogle\Src\SourceReader\Model;

use Devoogle\Src\Source\Model\Source;
use Illuminate\Database\Eloquent\Model;

class YoutubeChannel extends Model
{

    protected $table = 'youtube_channel';

    protected $attributes = [
        'source_id',
        'slug_id',
        'slug_name',
        'name',
        'is_user_channel'
    ];

    protected $dates = ['created_at', 'updated_at'];


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


    public function isUserChannel()
    {
        return (bool)$this->attributes['is_user_channel'];
    }

}