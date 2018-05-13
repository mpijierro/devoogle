<?php

namespace Devoogle\Src\ResourceRaw\Repository;

use Devoogle\Src\ResourceRaw\Model\ResourceRaw;

class ResourceRawRepositoryWrite
{

    public function save(ResourceRaw $resource)
    {
        return $resource->save();
    }

}