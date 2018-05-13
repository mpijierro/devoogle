<?php

namespace Devoogle\Src\SourceReader\Model;


use Illuminate\Database\Eloquent\Model;

class YoutubeVideo extends Model
{

    protected $table = 'youtube_video';

    protected $fillable = ['info'];

}