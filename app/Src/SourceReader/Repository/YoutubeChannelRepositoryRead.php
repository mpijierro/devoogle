<?php

namespace Devoogle\Src\SourceReader\VideoChannel\Repository;

use Devoogle\Src\SourceReader\VideoChannel\Model\YoutubeChannel;

class YoutubeChannelRepositoryRead
{

    public function all()
    {
        return YoutubeChannel::all();
    }

}