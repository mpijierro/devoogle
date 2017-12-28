<?php

namespace Mulidev\Src\Version\Repository;

use Mulidev\Src\Resource\Model\Resource;
use Mulidev\Src\Version\Model\Version;


class VersionRepositoryWrite
{

    public function save(Version $version)
    {
        return $version->save();
    }

    public function delete(Version $version)
    {
        $version->delete();
    }


}