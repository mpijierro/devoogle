<?php

namespace Devoogle\Src\SourceReader\VideoChannel\Repository;

use Devoogle\Src\SourceReader\Model\YoutubeChannel;

class YoutubeChannelRepositoryWrite
{

    public function save(YoutubeChannel $channel)
    {
        return $channel->save();
    }

}