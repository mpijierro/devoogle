<?php

namespace Mulidev\Src\Version\Repository;

use Mulidev\Src\Version\Model\Version;

class VersionRepositoryRead
{

    public function findByUuid(string $aUuid)
    {
        return Version::where('uuid', $aUuid)->firstOrFail();
    }

}