<?php

namespace Devoogle\Src\SourceReader\Library\RssProcessor\ProgramarFacil;

use Devoogle\Src\SourceReader\Library\RssProcessor\ProcessorRss20;

class Processor extends ProcessorRss20
{

    const RSS_URL = 'https://programarfacil.com/podcast/';

    const SLUG = 'programarfacil';

    public function slug(): string
    {
        return self::SLUG;
    }


    public function rssSlug(): string
    {
        return self::RSS_URL;
    }

}