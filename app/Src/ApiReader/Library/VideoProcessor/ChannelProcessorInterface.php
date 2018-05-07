<?php

namespace Devoogle\Src\ApiReader\Library\VideoProcessor;

use Devoogle\Src\ApiReader\VideoChannel\Model\VideoChannel;

interface ChannelProcessorInterface
{

    public function processChannel(VideoChannel $videoChannel);
}