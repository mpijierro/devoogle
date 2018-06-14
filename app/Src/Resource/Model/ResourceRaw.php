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

class ResourceRaw extends Model
{


    protected $table = 'resource_raw';

    protected $fillable = [
        'resource_id',
        'info',
    ];

    protected $dates = ['created_at', 'updated_at'];


    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }

}
