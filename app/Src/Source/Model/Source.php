<?php

namespace Devoogle\Src\Source\Model;

use Carbon\Carbon;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\SourceReader\Exceptions\SourceNotHasBeenProcessedException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Source extends Model
{
    use SoftDeletes;

    protected $table = 'source';

    protected $fillable = [
        'type_source_id',
        'name',
        'slug',
        'url',
        'last_time_processed',
    ];

    protected $dates = ['last_time_processed', 'created_at', 'updated_at'];


    public function typeSource()
    {
        return $this->belongsTo(TypeSource::class);
    }

    public function resource()
    {
        return $this->hasMany(Resource::class);
    }


    public function id()
    {
        return $this->attributes['id'];
    }


    public function name()
    {
        return $this->attributes['name'];
    }


    public function slug()
    {
        return $this->attributes['slug'];
    }


    public function url()
    {
        return $this->attributes['url'];
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
