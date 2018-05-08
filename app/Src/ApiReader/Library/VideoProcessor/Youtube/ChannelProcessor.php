<?php

namespace Devoogle\Src\ApiReader\Library\VideoProcessor\Youtube;

use Devoogle\Src\ApiReader\Exceptions\ResourceExistsException;
use Devoogle\Src\ApiReader\Library\VideoProcessor\ChannelProcessorInterface;
use Devoogle\Src\ApiReader\VideoChannel\Model\VideoChannel;
use Devoogle\Src\User\Model\User;
use Illuminate\Support\Collection;

class ChannelProcessor implements ChannelProcessorInterface
{

    private $videoChannel = null;

    private $user = null;

    /**
     * @var VideoProcessor
     */
    private $videoProcessor;

    /**
     * @var VideoFinder
     */
    private $videoFinder;


    public function __construct(VideoFinder $videoFinder, VideoProcessor $videoProcessor)
    {
        $this->videoProcessor = $videoProcessor;
        $this->videoFinder = $videoFinder;
    }


    public function processChannel(VideoChannel $videoChannel, User $user)
    {

        $this->initializeChannel($videoChannel);

        $this->initializeUser($user);

        $this->initializePageInfo();

        $this->processVideosByYear();
    }


    private function initializeChannel(VideoChannel $videoChannel)
    {
        $this->videoChannel = $videoChannel;
    }

    private function initializeUser(User $user)
    {
        $this->user = $user;
    }


    private function initializePageInfo()
    {
        $this->pageInfo = [];
    }


    private function processVideosByYear()
    {

        $videos = $this->videoFinder->find($this->videoChannel);

        $this->saveVideos($videos);

        echo "\r\n Video channel: ".$this->videoChannel->name()." ## num: ".$this->videoFinder->num();

    }

    private function saveVideos(Collection $videos)
    {
        foreach ($videos as $video) {
            try {
                $this->videoProcessor->processVideo($video, $this->user);

            } catch (ResourceExistsException $e) {
                continue;
            }

        }
    }

}