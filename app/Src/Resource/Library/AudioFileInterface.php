<?php
namespace Devoogle\Src\Resource\Library;

use Devoogle\Src\Resource\Model\Resource;

interface AudioFileInterface
{

    public function path(Resource $resource):string;

    public function exists(Resource $resource):bool;

}