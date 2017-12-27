<?php

namespace Mulidev\Src\Resource\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mulidev\Src\Category\Model\Category;
use Mulidev\Src\Lang\Model\Lang;
use Mulidev\Src\User\Model\User;
use Spatie\Tags\HasTags;

class Resource extends Model
{

    use SoftDeletes, HasTags;

    const LONG_RANDOM_STRING_IN_SLUG = 5;

    protected $table = 'resource';

    protected $fillable = [
        'uuid',
        'user_id',
        'category_id',
        'lang_id',
        'title',
        'description',
        'url',
        'slug',
        'reviewed',
        'comment'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function id()
    {
        return $this->attributes['id'];
    }

    public function uuid()
    {
        return $this->attributes['uuid'];
    }

    public function lang()
    {
        return $this->belongsTo(Lang::class);
    }

    public function title()
    {
        return $this->attributes['title'];
    }

    public function description()
    {
        return $this->attributes['description'];
    }

    public function url()
    {
        return $this->attributes['url'];
    }

    public function categoryId()
    {
        return $this->attributes['category_id'];
    }

    public function langId()
    {
        return $this->attributes['lang_id'];
    }

    /**
     * TODO: update with real validation
     * @return bool
     */
    public function isCorrectToSave()
    {
        return ( ! empty($this->title()) AND ! empty($this->url()));
    }

    public function isReviewed()
    {
        return $this->attributes['reviewed'];
    }
}
