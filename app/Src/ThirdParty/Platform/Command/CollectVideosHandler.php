<?php

namespace Devoogle\Src\ThirdParty\Platform\Command;


use Alaouy\Youtube\Facades\Youtube;
use Devoogle\Src\ThirdParty\VideoChannel\Repository\VideoChannelRepositoryRead;

class CollectVideosHandler
{
    /**
     * @var VideoChannelRepositoryRead
     */
    private $videoChannelRepositoryRead;

    private $videoChannels;

    public function __construct(VideoChannelRepositoryRead $videoChannelRepositoryRead)
    {
        $this->videoChannelRepositoryRead = $videoChannelRepositoryRead;
    }


    public function __invoke()
    {

        $this->findVideoChannels();

        $this->obtainVideos();
    }

    private function findVideoChannels()
    {
        $this->videoChannels = $this->videoChannelRepositoryRead->all();
    }

    private function obtainVideos()
    {


        foreach ($this->videoChannels as $videoChannel) {

            $videos = Youtube::getPlaylistsByChannelId($videoChannel->slugId());
        }

    }


}