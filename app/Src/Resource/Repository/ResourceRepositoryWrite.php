<?php

namespace Devoogle\Src\Resource\Repository;

use Devoogle\Src\Resource\Model\Resource;
use Symfony\Component\Routing\Exception\InvalidParameterException;


class ResourceRepositoryWrite
{

    public function save(Resource $resource)
    {

        if ($resource->isCorrectToSave()) {
            return $resource->save();
        }

        throw new InvalidParameterException('Resource incorrect');

    }

    public function delete(Resource $resource)
    {
        $resource->delete();
    }


}