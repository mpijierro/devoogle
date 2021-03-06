<?php

namespace Devoogle\Src\Category\Model;

use Devoogle\Src\Resource\Model\Resource;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    const VIDEO_CATEGORY_ID = 1;

    const AUDIO_CATEGORY_ID = 2;

    const WEB_CATEGORY_ID = 3;

    protected $table = 'category';

    protected $fillable = ['name', 'slug', 'description'];


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


    public function description()
    {
        return $this->attributes['description'];
    }


    public function isSlug(string $otherSlug)
    {
        return $this->slug() == $otherSlug;
    }


    public function isWeb()
    {
        return $this->id() == self::WEB_CATEGORY_ID;
    }

    public function isAudio (){
        return $this->id() == self::AUDIO_CATEGORY_ID;
    }

}
