<?php

namespace Devoogle\Src\Search\Model;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{

    protected $table = 'search';

    protected $fillable = [

        'original',
        'slug',
    ];

    protected $dates = ['created_at', 'updated_at'];


    public function original()
    {
        return $this->attributes['original'];
    }


    public function slug()
    {
        return $this->attributes['slug'];
    }
}
