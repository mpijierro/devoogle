<?php

namespace Devoogle\Src\SourceReader\Library\RssProcessor\DanielPrimo;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Source\Model\Source;
use Devoogle\Src\SourceReader\Library\ResourceWrapper;
use Devoogle\Src\SourceReader\Library\RssProcessor\AudioWrapper;
use Devoogle\Src\SourceReader\Library\RssProcessor\ProcessorRss20;
use SimpleXMLElement;

class Processor extends ProcessorRss20
{

    const RSS_URL = 'https://www.danielprimo.io/rss/feed.xml';

    const SLUG = 'danielprimo';


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

    public function process(Source $source)
    {
        $this->initialize($source);

        if ($this->source->hasBeenProcessed()) {
            $this->obtainContentFromFirstPage();
        } else {
            $this->obtainContentFromPages();
        }

        $this->updateTimeProcessed();

    }


    protected function obtainContentFromFirstPage()
    {

        $content = file_get_contents($this->rssSlug());

        $this->rssContent = new SimpleXmlElement($content);

        $this->processRss();

    }


    protected function obtainContentFromPages()
    {

        $end = false;
        $page = 1;

        do {
            try {

                $content = file_get_contents($this->urlResource($page));

                $this->rssContent = new SimpleXmlElement($content);

                $this->processRss();

                $page++;

            } catch (\Exception $e) {
                $end = true;
            }
        } while ( ! $end);


    }


    protected function processRss()
    {

        foreach ($this->rssContent->channel->item as $item) {

            $this->generateUuid();

            $this->processItem($item);

        }
    }

    protected function processItem(SimpleXMLElement $item)
    {

        $wrapper = new AudioWrapper($item);

        if ($this->audioExists($wrapper)) {
            return;
        }

        $this->saveResource($wrapper);

        $this->saveRaw($wrapper);

    }

    private function urlResource(int $page)
    {

        if ($page == 1) {
            return $this->rssSlug();
        }

        return $this->urlPaged($page);

    }

    private function urlPaged(int $page)
    {
        return $this->rssSlug() . "?paged=" . $page;
    }

    protected function sanitizeDescription(ResourceWrapper $audioWrapper)
    {
        $description = str_replace('.es/"', '.es/', $audioWrapper->description());

        $description .= ' - por Joel On Software';

        return $description;
    }
}