<?php

namespace Devoogle\Src\SourceReader\Library\RssProcessor;

use Devoogle\Src\Source\Model\Source;

interface RssProcessorInterface
{

    public function process(Source $source);


    public function slug(): string;
}