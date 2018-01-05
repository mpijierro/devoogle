<?php

namespace Devoogle\Src\ThirdParty\Platform\Command;

use Alaouy\Youtube\Facades\Youtube;
use Devoogle\Src\ThirdParty\Platform\Library\YoutubeGateway;
use Devoogle\Src\ThirdParty\Platform\Library\YoutubeProcessor;
use Devoogle\Src\ThirdParty\Platform\Repository\PlatformRepositoryRead;
use Devoogle\Src\ThirdParty\VideoChannel\Repository\VideoChannelRepositoryRead;

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

    public function __construct(
        VideoChannelRepositoryRead $videoChannelRepositoryRead,
        PlatformRepositoryRead $platformRepositoryRead,
        YoutubeProcessor $youtubeProcessor
    ) {
        $this->videoChannelRepositoryRead = $videoChannelRepositoryRead;
        $this->platformRepositoryRead = $platformRepositoryRead;
        $this->youtubeProcessor = $youtubeProcessor;
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

            $channelVideos = Youtube::listChannelVideos($videoChannel->slugId(), 30);

            $this->processVideos($channelVideos);
        }

    }


    private function processVideos(array $videos)
    {

        foreach ($videos as $video) {

            try {

                $youtubeGatewary = app(YoutubeGateway::class, ['video' => $video]);

                ($this->youtubeProcessor)($youtubeGatewary);

            } catch (\Exception $e) {

                continue;

            }
        }

    }

}
