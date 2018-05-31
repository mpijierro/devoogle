<?php

namespace Devoogle\Src\SourceReader\Command;

use Devoogle\Src\Source\Repository\SourceRepositoryRead;
use Devoogle\Src\SourceReader\Library\SourceProcessorFactory;

class SourceReadHandler
{

    /**
     * @var SourceRepositoryRead
     */
    private $sourceRepositoryRead;

    private $sources;

    /**
     * @var SourceProcessorFactory
     */
    private $factory;


    public function __construct(SourceRepositoryRead $sourceRepositoryRead, SourceProcessorFactory $factory)
    {
        $this->sourceRepositoryRead = $sourceRepositoryRead;
        $this->sources = collect();
        $this->factory = $factory;
    }


    public function __invoke()
    {
        $this->obtainSources();

        $this->processSources();

    }


    private function obtainSources()
    {
        $this->sources = $this->sourceRepositoryRead->all();
    }


    private function processSources()
    {

        foreach ($this->sources as $source) {

            if ($source->id != 5) {
                continue;
            }

            $processor = $this->factory->getInstance($source);

            $processor->process($source);

        }

    }
}