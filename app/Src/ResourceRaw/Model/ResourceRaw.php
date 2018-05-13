<?php

namespace Devoogle\Src\ResourceRaw\Model;

use Devoogle\Src\Resource\Model\Resource;
use Illuminate\Database\Eloquent\Model;

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
