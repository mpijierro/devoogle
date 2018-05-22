<?php

namespace Devoogle\Src\SourceReader\Library\RssProcessor\WeDevelopers;

use Devoogle\Src\SourceReader\Library\RssProcessor\ProcessorRss20;

class Processor extends ProcessorRss20
{

    const RSS_URL = 'http://wedevelopers.com/feed/podcast/';

    const SLUG = 'wedevelopers';

    public function slug(): string
    {
        return self::SLUG;
    }


    public function rssSlug(): string
    {
        return self::RSS_URL;
    }
}