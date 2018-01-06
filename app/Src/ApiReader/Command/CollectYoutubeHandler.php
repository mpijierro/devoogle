<?php

namespace Devoogle\Src\ApiReader\Command;

use Alaouy\Youtube\Facades\Youtube;
use Devoogle\Src\ApiReader\Library\YoutubeChannelProcessor;
use Devoogle\Src\ApiReader\Library\YoutubeGateway;
use Devoogle\Src\ApiReader\Library\YoutubeProcessor;
use Devoogle\Src\ApiReader\Repository\PlatformRepositoryRead;
use Devoogle\Src\ApiReader\VideoChannel\Model\VideoChannel;
use Devoogle\Src\ApiReader\VideoChannel\Repository\VideoChannelRepositoryRead;
use Illuminate\Support\Facades\DB;

class CollectYoutubeHandler
{

    /**
     * @var PlatformRepositoryRead
     */
    private $platformRepositoryRead;

    /**
     * @var VideoChannelRepositoryRead
     */
    private $videoChannelRepositoryRead;

    private $platform;

    private $videoChannels;
    /**
     * @var YoutubeProcessor
     */
    private $youtubeProcessor;
    /**
     * @var YoutubeChannelProcessor
     */
    private $youtubeChannelProcessor;

    public function __construct(
        VideoChannelRepositoryRead $videoChannelRepositoryRead,
        PlatformRepositoryRead $platformRepositoryRead,
        YoutubeProcessor $youtubeProcessor,
        YoutubeChannelProcessor $youtubeChannelProcessor
    ) {
        $this->videoChannelRepositoryRead = $videoChannelRepositoryRead;
        $this->platformRepositoryRead = $platformRepositoryRead;
        $this->youtubeProcessor = $youtubeProcessor;
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
