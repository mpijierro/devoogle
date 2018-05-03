<?php

namespace Devoogle\Src\ApiReader\Repository;

use Devoogle\Src\ApiReader\Model\Platform;

class PlatformRepositoryRead
{

    const YOUTUBE_ID = 1;


    public function obtainYoutube()
    {
        return Platform::findOrFail(self::YOUTUBE_ID);
    }

}