<?php

namespace Devoogle\Src\SourceReader\Library\ApiProcessor\Youtube;

class ChannelWrapper
{

    private $channel;


    public function __construct(\stdClass $channel)
    {
        $this->channel = $channel;
    }


    public function slugId()
    {
        return $this->channel->id;
    }

}