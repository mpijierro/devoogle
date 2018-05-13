<?php

namespace Devoogle\Src\SourceReader\Library;

use Devoogle\Src\Source\Model\Source;
use Devoogle\Src\SourceReader\Library\VideoProcessor\Youtube\YoutubeProcessor;

class SourceProcessorFactory
{

    private $map = [];


    public function __construct()
    {

        $this->fillMap();

    }


    private function fillMap()
    {

        $this->map = [
            Source::YOUTUBE_SLUG => YoutubeProcessor::class
        ];


    }


    public function getInstance(Source $source)
    {

        $processor = app($this->map [$source->slug()]);

        if ( ! $processor instanceof SourceProcessorInterface) {
            throw new \InvalidArgumentException();
        }

        return $processor;

    }

}