<?php

namespace Devoogle\Src\ThirdParty\Platform\Repository;


use Devoogle\Src\ThirdParty\Platform\Model\Platform;

class PlatformRepositoryRead
{

    const YOUTUBE_ID = 1;

    public function obtainYoutube()
    {
        return Platform::findOrFail(self::YOUTUBE_ID);
    }

}