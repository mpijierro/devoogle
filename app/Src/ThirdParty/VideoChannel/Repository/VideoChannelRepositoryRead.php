<?php


namespace Devoogle\Src\ThirdParty\VideoChannel\Repository;

use Devoogle\Src\ThirdParty\VideoChannel\Model\VideoChannel;

class VideoChannelRepositoryRead
{

    public function all()
    {
        return VideoChannel::all();
    }

}