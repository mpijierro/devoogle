<?php

namespace Devoogle\Src\Source\Repository;

use Devoogle\Src\Source\Model\Source;

class SourceRepositoryRead
{

    public function all()
    {
        return Source::all();
    }
}