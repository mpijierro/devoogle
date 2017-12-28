<?php

namespace Devoogle\Src\Version\Repository;

use Devoogle\Src\Version\Model\Version;

class VersionRepositoryRead
{

    public function findByUuid(string $aUuid)
    {
        return Version::where('uuid', $aUuid)->firstOrFail();
    }

}