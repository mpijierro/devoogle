<?php

namespace Devoogle\Src\SourceReader\Library\VideoProcessor;

use Devoogle\Src\SourceReader\VideoChannel\Model\YoutubeChannel;
use Devoogle\Src\User\Model\User;

interface ChannelProcessorInterface
{

    public function processChannel(YoutubeChannel $videoChannel, User $user);
}