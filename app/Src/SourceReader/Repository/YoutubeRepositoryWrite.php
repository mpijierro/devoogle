<?php

namespace Devoogle\Src\SourceReader\Repository;

use Devoogle\Src\SourceReader\Model\YoutubeVideo;

class YoutubeRepositoryWrite
{

    public function saveVideo(YoutubeVideo $youtubeVideo)
    {

        return $youtubeVideo->save();
    }
}