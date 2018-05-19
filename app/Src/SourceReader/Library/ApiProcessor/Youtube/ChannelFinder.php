<?php

namespace Devoogle\Src\SourceReader\Library\ApiProcessor\Youtube;

use Alaouy\Youtube\Facades\Youtube;
use Devoogle\Src\SourceReader\Exceptions\ChannelNotFoundException;

class ChannelFinder
{

    private $channelFinded;

    private $channel = null;


    public function findChannelByName(string $name)
    {
        $this->find($name);
        $this->toWrap();
    }


    private function find(string $name)
    {
        $this->channelFinded = Youtube::getChannelByName($name);
    }


    private function toWrap()
    {
        $this->channel = app(ChannelWrapper::class, ['channel' => $this->channelFinded]);
    }


    public function hasFound()
    {
        return ! is_null($this->channel);
    }


    public function channel(): ChannelWrapper
    {

        $this->checkHasChannel();

        return $this->channel;

    }


    private function checkHasChannel()
    {
        if (is_null($this->channel)) {
            throw new ChannelNotFoundException();
        }
    }
}