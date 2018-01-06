<?php

namespace Devoogle\Src\ApiReader\Platform\Repository;


use Devoogle\Src\ApiReader\Platform\Model\Platform;

class PlatformRepositoryRead
{

    const YOUTUBE_ID = 1;

    public function obtainYoutube()
    {
        return Platform::findOrFail(self::YOUTUBE_ID);
    }

}