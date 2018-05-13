<?php

namespace Devoogle\Src\SourceReader\Repository;

use Devoogle\Src\SourceReader\VideoChannel\Model\YoutubeChannel;

class VideoChannelRepositoryWrite
{

    public function save(YoutubeChannel $videoChannel)
    {
        return $videoChannel->save();
    }

}