<?php

namespace Devoogle\Src\SourceReader\Library\RssProcessor\EntreDevOps;

use Devoogle\Src\SourceReader\Library\RssProcessor\ProcessorRss20;

class Processor extends ProcessorRss20
{

    const RSS_URL = 'http://www.entredevyops.es/rss.xml';

    const SLUG = 'entredevyops';

    public function slug(): string
    {
        return self::SLUG;
    }


    public function rssSlug(): string
    {
        return self::RSS_URL;
    }

}