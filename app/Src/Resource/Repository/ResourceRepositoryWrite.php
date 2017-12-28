<?php

namespace Mulidev\Src\Resource\Repository;

use Mulidev\Src\Resource\Model\Resource;
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