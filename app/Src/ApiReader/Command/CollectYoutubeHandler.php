<?php

namespace Devoogle\Src\ApiReader\Command;

use Devoogle\Src\ApiReader\Library\VideoProcessor\Youtube\ChannelProcessor;
use Devoogle\Src\ApiReader\Repository\PlatformRepositoryRead;
use Devoogle\Src\ApiReader\VideoChannel\Repository\VideoChannelRepositoryRead;

class CollectYoutubeHandler
{

    private $platform;

    private $videoChannels;

    /**
     * @var VideoChannelRepositoryRead
     */
    private $videoChannelRepositoryRead;

    /**
     * @var PlatformRepositoryRead
     */
    private $platformRepositoryRead;

    /**
     * @var ChannelProcessor
     */
    private $channelProcessor;


    public function __construct(
        PlatformRepositoryRead $platformRepositoryRead,
        VideoChannelRepositoryRead $videoChannelRepositoryRead,
        ChannelProcessor $youtubeChannelProcessor
    ) {
        $this->platformRepositoryRead = $platformRepositoryRead;
        $this->videoChannelRepositoryRead = $videoChannelRepositoryRead;
        $this->channelProcessor = $youtubeChannelProcessor;
    }


    public function __invoke()
    {
        $this->findPlatform();

        $this->findVideoChannels();

        $this->obtainVideos();
    }

    private function findPlatform()
    {
        $this->platform = $this->platformRepositoryRead->obtainYoutube();
    }


    private function findVideoChannels()
    {
        $this->videoChannels = $this->platform->videoChannel;
    }

    private function obtainVideos()
    {

        foreach ($this->videoChannels as $channel) {

            $this->channelProcessor->processChannel($channel);
        }

    }

}
