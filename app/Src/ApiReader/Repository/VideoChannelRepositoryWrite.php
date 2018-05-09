<?php

namespace Devoogle\Src\ApiReader\Repository;

use Devoogle\Src\ApiReader\VideoChannel\Model\VideoChannel;

class VideoChannelRepositoryWrite
{

    public function save(VideoChannel $videoChannel)
    {
        return $videoChannel->save();
    }

}