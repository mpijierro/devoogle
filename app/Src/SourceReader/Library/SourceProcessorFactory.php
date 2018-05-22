<?php

namespace Devoogle\Src\SourceReader\Library;

use Devoogle\Src\Source\Model\Source;
use Devoogle\Src\SourceReader\Library\ApiProcessor\Youtube\Processor as YoutubeProcessor;
use Devoogle\Src\SourceReader\Library\RssProcessor\BastaYaDePicar\Processor as BastaYaDePicarProcessor;
use Devoogle\Src\SourceReader\Library\RssProcessor\EntreDevOps\Processor as EntreDevOps;
use Devoogle\Src\SourceReader\Library\RssProcessor\ProgramarEsUnaMierda\Processor as ProgramarEsUnaMierdaProcessor;
use Devoogle\Src\SourceReader\Library\RssProcessor\ProgramarFacil\Processor as ProgramarFacilProcessor;
use Devoogle\Src\SourceReader\Library\RssProcessor\RantPod\Processor as RantPodProcessor;
use Devoogle\Src\SourceReader\Library\RssProcessor\Tecnologeria\Processor as TecnologeriaProcessor;
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
            YoutubeProcessor::SLUG              => YoutubeProcessor::class,
            WedevelopersProcessor::SLUG         => WedevelopersProcessor::class,
            EntreDevOps::SLUG                   => EntreDevOps::class,
            BastaYaDePicarProcessor::SLUG       => BastaYaDePicarProcessor::class,
            ProgramarEsUnaMierdaProcessor::SLUG => ProgramarEsUnaMierdaProcessor::class,
            RantPodProcessor::SLUG              => RantPodProcessor::class,
            ProgramarFacilProcessor::SLUG       => ProgramarFacilProcessor::class,
            TecnologeriaProcessor::SLUG         => TecnologeriaProcessor::class,

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