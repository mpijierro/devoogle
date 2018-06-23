<?php

namespace Devoogle\Src\SourceReader\Library\ApiProcessor\Youtube;

use Carbon\Carbon;
use Devoogle\Src\Devoogle\Library\DateRange;
use Devoogle\Src\SourceReader\Exceptions\ResourceExistsException;
use Devoogle\Src\SourceReader\Exceptions\VideoIsNotProcessedException;
use Devoogle\Src\SourceReader\Model\YoutubeChannel;
use Devoogle\Src\SourceReader\Repository\VideoChannelRepositoryWrite;

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


    public function processNewVideos(YoutubeChannel $channel, Carbon $lastTimeProcessed)
    {

        $this->initializeChannel($channel);

        $this->initializePageInfo();

        $this->obtainNewVideos($lastTimeProcessed);

        $this->saveVideos();

    }


    private function initializeChannel(YoutubeChannel $videoChannel)
    {
        $this->channel = $videoChannel;

        if ($videoChannel->isUserChannel()) {
            $this->setupUserChannelId();
        }

    }


    private function setupUserChannelId()
    {

        $channelFinder = app(ChannelFinder::class);
        $channelFinder->findChannelByName($this->channel->slugId());

        if ($channelFinder->hasFound()) {
            $channel = $channelFinder->channel();
            $this->channel->changeSlugIdFromUserToId($channel->slugId());

        }

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


    private function obtainNewVideos(Carbon $lastTimeProcessed)
    {

        $range = new DateRange($lastTimeProcessed, Carbon::now());

        $finder = app(FinderByDateRange::class);

        $this->videos = $finder->find($this->channel, $range);

        echo "\r\n Video channel: ".$this->channel->name()." ## num: ".$finder->num();

    }


    private function saveVideos()
    {

        foreach ($this->videos as $video) {

            try {

                $this->videoProcessor->processVideo($video, $this->channel);

            } catch (ResourceExistsException $e) {

                //TODO: to log exception, send email
                continue;
            } catch (VideoIsNotProcessedException $e) {
                //TODO: to log exception, send email
                continue;
            }

        }
    }

}
