<?php

namespace Devoogle\Src\Resource\Model;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Devoogle\Library\SanitizeDescription;
use Devoogle\Src\Lang\Model\Lang;
use Devoogle\Src\Source\Model\Source;
use Devoogle\Src\SourceReader\Model\YoutubeChannel;
use Devoogle\Src\Tag\Model\Tag;
use Devoogle\Src\User\Model\User;
use Devoogle\Src\Version\Model\Version;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Tags\HasTags;

class Resource extends Model
{

    const LONG_RANDOM_STRING_IN_SLUG = 5;

    use SoftDeletes, HasTags;

    protected $table = 'resource';

    protected $fillable = [
        'uuid',
        'user_id',
        'source_id',
        'category_id',
        'lang_id',
        'title',
        'description',
        'url',
        'slug',
        'published_at',
        'reviewed'
    ];

    protected $with = ['user', 'category', 'lang', 'tags', 'source', 'channel', 'channel.source', 'version'];

    protected $dates = ['published_at', 'created_at', 'updated_at', 'deleted_at'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function raw()
    {
        return $this->hasOne(ResourceRaw::class);
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
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
        return $this->belongsToMany(User::class, 'favourite')->withTimestamps();
    }


    public function later()
    {
        return $this->belongsToMany(User::class, 'later')->withTimestamps();
    }

    public function channel()
    {
        return $this->belongsToMany(YoutubeChannel::class, 'resource_channel');
    }

    public function viewed()
    {
        return $this->belongsToMany(User::class, 'viewed')->withTimestamps();
    }

    public function author()
    {
        return $this->tagsWithType(Tag::TYPE_AUTHOR);
    }


    public function event()
    {
        return $this->tagsWithType(Tag::TYPE_EVENT);
    }


    public function technology()
    {
        return $this->tagsWithType(Tag::TYPE_TECHNOLOGY);
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


    public function sourceId()
    {
        return $this->attributes['source_id'];
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


    // TODO: convert to DescriptionModificator class
    public function sanititizeDescription()
    {

        $finder = app(SanitizeDescription::class);

        if ($this->category->isWeb()) {
            return $finder->sanitizeWeb($this->description());
        }

        return $finder->sanitize($this->description());

    }


    // TODO: convert to DescriptionModificator class
    public function addBoldToDescription(string $tag)
    {

        $tag = $this->sanitizeTag($tag);

        preg_match('/' . $tag . '/i', $this->description, $matches);

        if ($matches) {
            $this->description = str_replace($matches[0], '<b>' . $matches[0] . '</b>', $this->description);
        }
    }

    private function sanitizeTag(string $tag)
    {
        $tag = trim($tag);

        $tag = mb_strtolower($tag);

        $tag = str_replace('+', '\+', $tag);
        $tag = str_replace('(', '\(', $tag);
        $tag = str_replace(')', '\)', $tag);
        $tag = str_replace('[', '\[', $tag);
        $tag = str_replace(']', '\]', $tag);
        $tag = str_replace('.', '\.', $tag);
        $tag = str_replace('/', '\/', $tag);

        return $tag;
    }


    public function allTags()
    {

        $tags = collect();

        foreach ($this->author() as $tag) {
            $tags->push($tag);
        }

        foreach ($this->event() as $tag) {
            $tags->push($tag);
        }

        foreach ($this->technology() as $tag) {
            $tags->push($tag);
        }

        foreach ($this->tagsWithoutType() as $tag) {
            $tags->push($tag);
        }

        return $tags;

    }

    public function hasSource()
    {
        return ! is_null($this->sourceId());
    }

    public function hasDescription()
    {
        return ! empty(trim($this->description()));
    }


    public function url()
    {
        return $this->attributes['url'];
    }


    public function publishedAt()
    {
        return $this->published_at;
    }


    /**
     * TODO: update with real validation
     * @return bool
     */
    public function isCorrectToSave()
    {
        return ( ! empty($this->title()) AND ! empty($this->url()));
    }


    public function isReviewed(): bool
    {
        return $this->attributes['reviewed'] ? true : false;
    }


    public function isOwner(User $user): bool
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


    public function isFavourite(User $user): bool
    {
        return (bool)$this->favourite()->wherePivot('user_id', $user->id())->count();
    }


    public function isLater(User $user): bool
    {
        return (bool)$this->later()->wherePivot('user_id', $user->id())->count();
    }


    public function isViewed(User $user): bool
    {
        return (bool)$this->viewed()->wherePivot('user_id', $user->id())->count();
    }

    public function favouriteCount()
    {
        return $this->attributes['favourite_count'];
    }

    public function isFromYoutubeChannel()
    {
        return $this->channel->count();
    }

    public function sourceUrl()
    {
        if ($this->isFromYoutubeChannel()) {
            return $this->channel->first()->url();
        }

        return $this->source->url();

    }

    public function sourceName()
    {
        if ($this->isFromYoutubeChannel()) {
            return $this->channel->first()->source->name . ' | ' . $this->channel->first()->name();
        }

        return $this->source->name();

    }
}
