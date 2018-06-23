<?php

namespace Devoogle\Src\SourceReader\Model;

use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\Source\Model\Source;
use Devoogle\Src\SourceReader\Exceptions\SourceNotHasBeenProcessedException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class YoutubeChannel extends Model
{
    const URL_CHANNEL = 'https://www.youtube.com/channel/';

    const URL_USER = 'https://www.youtube.com/user/';

    protected $table = 'youtube_channel';

    protected $attributes = [
        'source_id',
        'slug_id',
        'slug_name',
        'name',
        'is_user_channel',
        'last_time_processed',
    ];

    protected $dates = ['created_at', 'updated_at', 'last_time_processed'];


    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function channel()
    {
        return $this->belongsToMany(Resource::class, 'resource_channel');
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

    public function url()
    {

        if ($this->isUserChannel()) {
            return self::URL_USER.$this->slugId();
        }

        return self::URL_CHANNEL.$this->slugId();
    }


    public function changeSlugIdFromUserToId(string $slugId)
    {

        $this->slug_id = $slugId;
        $this->is_user_channel = false;
    }


    public function lastTimeProcessed(): Carbon
    {
        if ( ! $this->hasBeenProcessed()) {
            throw new SourceNotHasBeenProcessedException();
        }

        return $this->last_time_processed;
    }


    public function hasBeenProcessed(): bool
    {
        return ! is_null($this->attributes['last_time_processed']);
    }

}