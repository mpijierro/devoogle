<?php

namespace Devoogle\Src\SourceReader\Library\ApiProcessor\Youtube;

use Carbon\Carbon;
use Devoogle\Src\Source\Model\Source;
use Devoogle\Src\Source\Repository\SourceRepositoryWrite;
use Devoogle\Src\SourceReader\Library\SourceProcessorInterface;
use Devoogle\Src\SourceReader\Model\YoutubeChannel;
use Devoogle\Src\SourceReader\Repository\YoutubeChannelRepositoryRead;
use Devoogle\Src\SourceReader\Repository\YoutubeChannelRepositoryWrite;

class Processor implements SourceProcessorInterface
{

    const SLUG = 'youtube';

    private $source;

    private $channels;

    /**
     * @var YoutubeChannelRepositoryRead
     */
    private $channelsRepository;

    /**
     * @var ChannelProcessor
     */
    private $channelProcessor;

    /**
     * @var SourceRepositoryWrite
     */
    private $sourceRepositoryWrite;

    /**
     * @var YoutubeChannelRepositoryWrite
     */
    private $youtubeChannelRepositoryWrite;


    public function __construct(
        SourceRepositoryWrite $sourceRepositoryWrite,
        YoutubeChannelRepositoryRead $channelsRepository,
        ChannelProcessor $youtubeChannelProcessor,
        YoutubeChannelRepositoryWrite $youtubeChannelRepositoryWrite
    ) {
        $this->sourceRepositoryWrite = $sourceRepositoryWrite;
        $this->channelsRepository = $channelsRepository;
        $this->channelProcessor = $youtubeChannelProcessor;
        $this->youtubeChannelRepositoryWrite = $youtubeChannelRepositoryWrite;
    }


    public function process(Source $source)
    {
        $this->initialize($source);

        $this->obtainChannels();

        $this->processChannels();

        $this->updateSourceTimeProcessed();
    }


    public function slug(): string
    {
        return self::SLUG;
    }


    private function initialize(Source $source)
    {
        $this->source = $source;
    }


    private function obtainChannels()
    {
        $this->channels = $this->channelsRepository->all();
    }


    private function processChannels()
    {

        foreach ($this->channels as $channel) {

            $this->processChannel($channel);

        }
    }


    private function processChannel(YoutubeChannel $channel)
    {

        if ($channel->hasBeenProcessed()) {
            $this->channelProcessor->processNewVideos($channel, $channel->lastTimeProcessed());
        } else {
            $this->channelProcessor->processAllVideos($channel);
        }

        $this->updateChannelTimeProcessed($channel);
    }


    private function updateChannelTimeProcessed(YoutubeChannel $channel)
    {
        $channel->last_time_processed = Carbon::now();
        $this->youtubeChannelRepositoryWrite->save($channel);
    }


    private function updateSourceTimeProcessed()
    {
        $this->source->last_time_processed = Carbon::now();

        $this->sourceRepositoryWrite->save($this->source);
    }


    public function rssSlug(): string
    {
        // TODO: Implement rssSlug() method.
    }
}
