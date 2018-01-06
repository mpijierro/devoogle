<?php


namespace Devoogle\Src\ApiReader\VideoChannel\Repository;

use Devoogle\Src\ApiReader\VideoChannel\Model\VideoChannel;

class VideoChannelRepositoryRead
{

    public function all()
    {
        return VideoChannel::all();
    }

}