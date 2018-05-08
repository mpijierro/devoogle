<?php

namespace Devoogle\Src\ApiReader\Repository;

use Devoogle\Src\ApiReader\Model\YoutubeVideo;

class YoutubeRepositoryWrite
{

    public function saveVideo(YoutubeVideo $youtubeVideo)
    {

        return $youtubeVideo->save();
    }
}