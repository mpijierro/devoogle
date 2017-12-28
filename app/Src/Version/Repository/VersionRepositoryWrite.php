<?php

namespace Devoogle\Src\Version\Repository;

use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\Version\Model\Version;


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