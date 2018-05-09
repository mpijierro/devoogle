<?php

namespace Devoogle\Src\ApiReader\Library\VideoProcessor\Youtube;

use Carbon\Carbon;
use Devoogle\Src\ApiReader\Exceptions\ResourceExistsException;
use Devoogle\Src\ApiReader\Library\VideoProcessor\ChannelProcessorInterface;
use Devoogle\Src\ApiReader\VideoChannel\Model\VideoChannel;
use Devoogle\Src\ApiReader\Repository\VideoChannelRepositoryWrite;
use Devoogle\Src\Devoogle\Library\DateRange;
use Devoogle\Src\User\Model\User;

class ChannelProcessor implements ChannelProcessorInterface
{

    private $videoChannel = null;

    private $user = null;

    /**
     * @var VideoProcessor
     */
    private $videoProcessor;

    private $videos;

    /**
     * @var VideoChannelRepositoryWrite
     */
    private $videoChannelRepositoryWrite;


    public function __construct(VideoProcessor $videoProcessor, VideoChannelRepositoryWrite $videoChannelRepositoryWrite)
    {
        $this->videoProcessor = $videoProcessor;
        $this->videos = collect();
        $this->videoChannelRepositoryWrite = $videoChannelRepositoryWrite;
    }


    public function processChannel(VideoChannel $videoChannel, User $user)
    {

        $this->initializeChannel($videoChannel);

        $this->initializeUser($user);

        $this->initializePageInfo();

        $this->obtainVideos();

        $this->saveVideos();

        $this->updateLasTimeProcessed();
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


    private function obtainVideos()
    {

        if ($this->videoChannel->hasBeenProcessed()) {
            $this->obtainNewVideos();
        } else {
            $this->obtainAllVideos();
        }

    }


    private function obtainAllVideos()
    {

        $finder = app(FinderByYears::class);

        $this->videos = $finder->find($this->videoChannel);

        echo "\r\n Video channel: ".$this->videoChannel->name()." ## num: ".$finder->num();

    }


    private function obtainNewVideos()
    {

        $lastTime = $this->videoChannel->lastTimeProcessed();

        $range = new DateRange($lastTime, Carbon::now());

        $finder = app(FinderByDateRange::class);

        $this->videos = $finder->find($this->videoChannel, $range);

        echo "\r\n Video channel: ".$this->videoChannel->name()." ## num: ".$finder->num();

    }


    private function saveVideos()
    {
        foreach ($this->videos as $video) {
            try {
                $this->videoProcessor->processVideo($video, $this->user);

            } catch (ResourceExistsException $e) {
                continue;
            }

        }
    }


    private function updateLasTimeProcessed()
    {
        $this->videoChannel->last_time_processed = Carbon::now();
        $this->videoChannelRepositoryWrite->save($this->videoChannel);
    }

}