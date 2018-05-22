<?php

namespace Devoogle\Src\SourceReader\Library\ApiProcessor\Youtube;

use Carbon\Carbon;
use Devoogle\Src\Source\Model\Source;
use Devoogle\Src\Source\Repository\SourceRepositoryWrite;
use Devoogle\Src\SourceReader\Library\SourceProcessorInterface;
use Devoogle\Src\SourceReader\Model\YoutubeChannel;
use Devoogle\Src\SourceReader\VideoChannel\Repository\YoutubeChannelRepositoryRead;

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


    public function __construct(
        SourceRepositoryWrite $sourceRepositoryWrite,
        YoutubeChannelRepositoryRead $channelsRepository,
        ChannelProcessor $youtubeChannelProcessor
    ) {
        $this->sourceRepositoryWrite = $sourceRepositoryWrite;
        $this->channelsRepository = $channelsRepository;
        $this->channelProcessor = $youtubeChannelProcessor;
    }


    public function process(Source $source)
    {
        $this->initialize($source);

        $this->obtainChannels();

        $this->processChannels();

        $this->updateTimeProcessed();
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

        if ($this->source->hasBeenProcessed()) {
            $this->channelProcessor->processNewVideos($channel, $this->source->lastTimeProcessed());
        } else {
            $this->channelProcessor->processAllVideos($channel);
        }

    }


    private function updateTimeProcessed()
    {
        $this->source->last_time_processed = Carbon::now();

        $this->sourceRepositoryWrite->save($this->source);
    }


    public function rssSlug(): string
    {
        // TODO: Implement rssSlug() method.
    }
}
