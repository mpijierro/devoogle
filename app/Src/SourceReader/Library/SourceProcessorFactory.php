<?php

namespace Devoogle\Src\SourceReader\Library;

use Devoogle\Src\Source\Model\Source;
use Devoogle\Src\SourceReader\Library\ApiProcessor\Youtube\Processor as YoutubeProcessor;
use Devoogle\Src\SourceReader\Library\RssProcessor\WeDevelopers\Processor as WedevelopersProcessor;

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
            YoutubeProcessor::SLUG      => YoutubeProcessor::class,
            WedevelopersProcessor::SLUG => WedevelopersProcessor::class
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