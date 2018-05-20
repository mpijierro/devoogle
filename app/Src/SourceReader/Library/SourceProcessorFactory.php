<?php

namespace Devoogle\Src\SourceReader\Library;

use Devoogle\Src\Source\Model\Source;
use Devoogle\Src\SourceReader\Library\ApiProcessor\Youtube\Processor as YoutubeProcessor;
use Devoogle\Src\SourceReader\Library\RssProcessor\EntreDevOps\Processor as EntreDevOps;
use Devoogle\Src\SourceReader\Library\RssProcessor\WeDevelopers\Processor as WedevelopersProcessor;
use Devoogle\Src\SourceReader\Library\RssProcessor\BastaYaDePicar\Processor as BastaYaDePicarProcessor;

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
            YoutubeProcessor::SLUG        => YoutubeProcessor::class,
            WedevelopersProcessor::SLUG   => WedevelopersProcessor::class,
            EntreDevOps::SLUG             => EntreDevOps::class,
            BastaYaDePicarProcessor::SLUG => BastaYaDePicarProcessor::class

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