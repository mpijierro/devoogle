<?php

namespace Devoogle\Src\Source\Repository;

use Devoogle\Src\Source\Model\Source;

class SourceRepositoryRead
{

    public function all()
    {
        return Source::all();
    }

    public function activeSource (){
        return Source::where('active',1)->get();
    }

    public function obtainYoutube()
    {
        return Source::where('slug', 'youtube')->first();
    }
}