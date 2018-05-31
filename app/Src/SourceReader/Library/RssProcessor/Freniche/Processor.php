<?php

namespace Devoogle\Src\SourceReader\Library\RssProcessor\Freniche;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\SourceReader\Library\RssProcessor\AudioWrapper;
use Devoogle\Src\SourceReader\Library\RssProcessor\ProcessorRss20;
use SimpleXMLElement;

class Processor extends ProcessorRss20
{

    const RSS_URL = 'http://blog.freniche.com/feed/?paged=3';

    const SLUG = 'diegofreniche';


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
        return Category::WEB_CATEGORY_ID;
    }

    protected function processItem(SimpleXMLElement $item)
    {

        foreach ((array)$item->category as $category) {


            if ( ! $this->belongsToAnInterestingCategory((string)$category)) {
                continue;
            }

        }

        $wrapper = new AudioWrapper($item);

        if ($this->audioExists($wrapper)) {
            return;
        }


        //$this->saveAudio($wrapper);

        //$this->saveRaw($wrapper);

    }

    private function belongsToAnInterestingCategory(string $aCategory)
    {

        foreach ($this->categories() as $category) {

            if ($category == $aCategory) {
                return true;
            }
        }

        return false;


    }

    private function categories()
    {
        return [
            'fraudismo',
            'Programación',
            'Informática'
        ];
    }
}