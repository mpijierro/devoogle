<?php

namespace Devoogle\Src\SourceReader\Library\VideoProcessor\Youtube;

use Carbon\Carbon;
use Devoogle\Src\Source\Model\Source;
use Devoogle\Src\Source\Repository\SourceRepositoryWrite;
use Devoogle\Src\SourceReader\Library\SourceProcessorInterface;
use Devoogle\Src\SourceReader\VideoChannel\Repository\YoutubeChannelRepositoryRead;

class YoutubeProcessor implements SourceProcessorInterface
{

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

        $this->obtainVideos();

        $this->updateTimeProcessed();
    }


    private function initialize(Source $source)
    {
        $this->source = $source;
    }


    private function obtainChannels()
    {
        $this->channels = $this->channelsRepository->all();
    }


    private function obtainVideos()
    {

        foreach ($this->channels as $channel) {

            if ($this->source->hasBeenProcessed()) {
                $this->channelProcessor->processNewVideos($channel);
            } else {
                $this->channelProcessor->processAllVideos($channel);
            }
        }

    }


    private function updateTimeProcessed()
    {
        $this->source->last_time_processed = Carbon::now();

        dd($this->source);

        $this->sourceRepositoryWrite->save($this->source);
    }
}
