<?php

namespace Devoogle\Src\SourceReader\Repository;

use Devoogle\Src\SourceReader\Model\YoutubeChannel;

class YoutubeChannelRepositoryRead
{

    public function all()
    {
        return YoutubeChannel::all();
    }

}