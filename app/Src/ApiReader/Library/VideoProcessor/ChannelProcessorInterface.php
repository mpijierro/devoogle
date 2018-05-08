<?php

namespace Devoogle\Src\ApiReader\Library\VideoProcessor;

use Devoogle\Src\ApiReader\VideoChannel\Model\VideoChannel;
use Devoogle\Src\User\Model\User;

interface ChannelProcessorInterface
{

    public function processChannel(VideoChannel $videoChannel, User $user);
}