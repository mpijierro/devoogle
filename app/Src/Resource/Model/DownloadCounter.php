<?php

namespace Devoogle\Src\Resource\Model;

use Illuminate\Database\Eloquent\Model;

class DownloadCounter extends Model
{

    protected $table = 'download_counter';

    protected $fillable = [
        'resource_id',
    ];

    protected $dates = ['created_at', 'updated_at'];


    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }
}