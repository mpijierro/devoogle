<?php

namespace Devoogle\Src\SourceReader\Library\RssProcessor\ProgramarEsUnaMierda;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\SourceReader\Library\RssProcessor\ProcessorRss20;
use SimpleXMLElement;

class Processor extends ProcessorRss20
{

    const RSS_URL = 'http://www.programaresunamierda.com/feeds/posts/default?max-results=500';

    const SLUG = 'programaresunamierda';


    public function slug(): string
    {
        return self::SLUG;
    }


    protected function processRss()
    {

        foreach ($this->rssContent->entry as $item) {

            $this->generateUuid();

            $this->processItem($item);

        }
    }


    protected function processItem(SimpleXMLElement $item)
    {

        $wrapper = new AudioWrapper($item);

        if ( ! $this->isCorrect($wrapper)) {
            return;
        }

        $this->saveResource($wrapper);

        $this->saveRaw($wrapper);

    }


    private function isCorrect(AudioWrapper $audioWrapper)
    {

        if ($this->audioExists($audioWrapper)) {
            return false;
        }

        if ( ! $audioWrapper->hasUrl()) {
            return false;
        }

        return true;
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