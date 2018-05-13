<?php

namespace Devoogle\Src\Source\Repository;

use Devoogle\Src\Source\Model\Source;

class SourceRepositoryWrite
{

    public function save(Source $source)
    {
        return $source->save();
    }
}