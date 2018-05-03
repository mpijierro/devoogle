<?php

namespace Devoogle\Src\ApiReader\Command;

use Devoogle\Src\ApiReader\Library\YoutubeChannelProcessor;
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
     * @var YoutubeChannelProcessor
     */
    private $youtubeChannelProcessor;


    public function __construct(
        VideoChannelRepositoryRead $videoChannelRepositoryRead,
        PlatformRepositoryRead $platformRepositoryRead,
        YoutubeChannelProcessor $youtubeChannelProcessor
    ) {
        $this->videoChannelRepositoryRead = $videoChannelRepositoryRead;
        $this->platformRepositoryRead = $platformRepositoryRead;
        $this->youtubeChannelProcessor = $youtubeChannelProcessor;
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

        foreach ($this->videoChannels as $videoChannel) {

            ($this->youtubeChannelProcessor)($videoChannel);
        }

    }

}
