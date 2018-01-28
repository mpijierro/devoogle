<?php

namespace Devoogle\Src\Version\Model;

use Illuminate\Database\Eloquent\Model;
use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\User\Model\User;
use Illuminate\Database\Eloquent\SoftDeletes;


class Version extends Model
{

    use SoftDeletes;

    protected $table = 'resource_version';

    protected $fillable = [
        'uuid',
        'user_id',
        'resource_id',
        'category_id',
        'url',
        'comment',
        'reviewed',
    ];

    protected $with = ['category'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function id()
    {
        return $this->attributes['id'];
    }

    public function userId()
    {
        return $this->attributes['user_id'];
    }

    public function uuid()
    {
        return $this->attributes['uuid'];
    }

    public function categoryId()
    {
        return $this->attributes['category_id'];
    }

    public function url()
    {
        return $this->attributes['url'];
    }

    public function comment()
    {
        return $this->attributes['comment'];
    }

    public function isReviewed()
    {
        return $this->attributes['reviewed'];
    }
}
