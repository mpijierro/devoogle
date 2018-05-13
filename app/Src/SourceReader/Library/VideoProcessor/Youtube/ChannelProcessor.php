<?php

namespace Devoogle\Src\SourceReader\Library\VideoProcessor\Youtube;

use Carbon\Carbon;
use Devoogle\Src\Devoogle\Library\DateRange;
use Devoogle\Src\SourceReader\Exceptions\ResourceExistsException;
use Devoogle\Src\SourceReader\Repository\VideoChannelRepositoryWrite;
use Devoogle\Src\SourceReader\VideoChannel\Model\YoutubeChannel;

class ChannelProcessor
{

    private $channel = null;

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


    public function processAllVideos(YoutubeChannel $channel)
    {

        $this->initializeChannel($channel);

        $this->initializePageInfo();

        $this->obtainAllVideos();

        $this->saveVideos();
    }


    private function initializeChannel(YoutubeChannel $videoChannel)
    {
        $this->channel = $videoChannel;
    }


    private function initializePageInfo()
    {
        $this->pageInfo = [];
    }


    private function obtainAllVideos()
    {

        $finder = app(FinderByYears::class);

        $this->videos = $finder->find($this->channel);

        echo "\r\n Video channel: ".$this->channel->name()." ## num: ".$finder->num();

    }


    private function saveVideos()
    {

        foreach ($this->videos as $video) {
            try {

                $this->videoProcessor->processVideo($video);

            } catch (ResourceExistsException $e) {

                continue;
            }

        }
    }


    public function processNewVideos(YoutubeChannel $channel)
    {
        //TODO: refactor
        $this->initializeChannel($channel);

        $this->initializePageInfo();

        $this->obtainNewVideos();

        $this->saveVideos();

    }


    private function obtainNewVideos()
    {

        $lastTime = $this->channel->lastTimeProcessed();

        $range = new DateRange($lastTime, Carbon::now());

        $finder = app(FinderByDateRange::class);

        $this->videos = $finder->find($this->channel, $range);

        echo "\r\n Video channel: ".$this->channel->name()." ## num: ".$finder->num();

    }

}