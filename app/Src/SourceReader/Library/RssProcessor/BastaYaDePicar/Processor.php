<?php

namespace Devoogle\Src\SourceReader\Library\RssProcessor\BastaYaDePicar;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\SourceReader\Library\RssProcessor\ProcessorRss20;

class Processor extends ProcessorRss20
{

    const RSS_URL = 'http://www.bastayadepicar.com/rss.xml';

    const SLUG = 'bastayadepicar';


    public function slug(): string
    {
        return self::SLUG;
    }


    public function rssSlug(): string
    {
        return self::RSS_URL;
    }


    protected function categoryId(): int
    {
        return Category::AUDIO_CATEGORY_ID;
    }
}