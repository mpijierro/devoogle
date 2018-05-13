<?php

namespace Devoogle\Src\SourceReader\Library;

use Devoogle\Src\Source\Model\Source;

interface SourceProcessorInterface
{

    public function process(Source $source);
}