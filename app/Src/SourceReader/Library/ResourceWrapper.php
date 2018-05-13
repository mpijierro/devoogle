<?php

namespace Devoogle\Src\SourceReader\Library;

use Carbon\Carbon;
use Illuminate\Support\Collection;

abstract class ResourceWrapper
{

    abstract public function url(): string;


    abstract public function publishedAt(): Carbon;


    abstract public function obtainTextsForSearch(): Collection;


    abstract public function title(): string;


    abstract public function description(): string;

}