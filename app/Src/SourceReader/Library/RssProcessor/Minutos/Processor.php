<?php

namespace Devoogle\Src\SourceReader\Library\RssProcessor\Minutos;

use Devoogle\Src\SourceReader\Library\RssProcessor\ProcessorRss20;

class Processor extends ProcessorRss20
{

    const RSS_URL = 'http://www.32minutos.net/?feed=rss2';

    const SLUG = '32minutos';

    public function slug(): string
    {
        return self::SLUG;
    }


    public function rssSlug(): string
    {
        return self::RSS_URL;
    }

}