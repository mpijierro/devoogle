<?php

namespace Devoogle\Src\Resource\Model;

use Devoogle\Src\Tag\Model\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\User\Model\User;
use Devoogle\Src\Version\Model\Version;
use Spatie\Tags\HasTags;

class Resource extends Model
{

    const LONG_RANDOM_STRING_IN_SLUG = 5;

    use SoftDeletes, HasTags;

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
        'reviewed'
    ];

    protected $with = ['user', 'category', 'lang', 'tags'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function lang()
    {
        return $this->belongsTo(Lang::class);
    }

    public function version()
    {
        return $this->hasMany(Version::class);
    }

    public function favourite()
    {
        return $this->belongsToMany(Resource::class, 'favourite')->withTimestamps();
    }

    public function author()
    {
        return $this->tagsWithType(Tag::TYPE_AUTHOR);
    }

    public function event()
    {
        return $this->tagsWithType(Tag::TYPE_EVENT);
    }

    public function tagsWithoutType()
    {

        return $this->tags->filter(function ($tag) {

            if (is_null($tag->type)) {
                return $tag;
            }

        });
    }

    public function userId()
    {
        return $this->attributes['user_id'];
    }

    public function categoryId()
    {
        return $this->attributes['category_id'];
    }

    public function langId()
    {
        return $this->attributes['lang_id'];
    }

    public function id()
    {
        return $this->attributes['id'];
    }

    public function uuid()
    {
        return $this->attributes['uuid'];
    }

    public function title()
    {
        return $this->attributes['title'];
    }

    public function description()
    {
        return $this->attributes['description'];
    }


    public function hasDescription()
    {
        return ! empty($this->description());
    }

    public function url()
    {
        return $this->attributes['url'];
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

    public function isOwner(User $user)
    {
        return $this->user_id == $user->id();
    }

    public function canWrite(User $user)
    {
        return (( ! $this->isReviewed() and $this->isOwner($user)) OR isAdmin());
    }

    public function canCheck()
    {
        return (isAdmin() and ! $this->isReviewed());
    }

    public function isFavourite()
    {

        return $this->favourite()->count();

    }
}
