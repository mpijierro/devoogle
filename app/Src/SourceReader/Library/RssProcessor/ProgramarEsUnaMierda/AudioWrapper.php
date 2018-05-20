<?php

namespace Devoogle\Src\SourceReader\Library\RssProcessor\ProgramarEsUnaMierda;

use Carbon\Carbon;
use Devoogle\Src\SourceReader\Library\ResourceWrapper;
use Illuminate\Support\Collection;

class AudioWrapper extends ResourceWrapper
{

    /**
     * @var \SimpleXMLElement
     */
    private $element;

    private $textsForTagSearch = '';


    public function __construct(\SimpleXMLElement $element)
    {
        $this->element = $element;

        $this->generateTextsForSearch();
    }


    private function generateTextsForSearch()
    {

        $this->textsForTagSearch = collect();

        if ( ! empty($this->title())) {
            $this->textsForTagSearch->push($this->title());
        }

        if ( ! empty($this->description())) {
            $this->textsForTagSearch->push($this->description());
        }

        return $this->textsForTagSearch;

    }


    public function title(): string
    {
        return $this->element->title;
    }


    public function description(): string
    {
        return (string)$this->element->content;
    }


    public function element()
    {
        return $this->element;
    }


    public function hasUrl(): bool
    {
        return ! empty(trim($this->url()));
    }


    public function url(): string
    {

        $links = collect($this->element->link);

        $url = $links->last();

        foreach ($url->attributes() as $key => $value) {
            if ($key == 'href') {
                return (string)$value;
            }
        }

        return '';
    }


    public function publishedAt(): Carbon
    {
        return Carbon::parse((string)$this->element->published);
    }


    public function obtainTextsForSearch(): Collection
    {

        $textsForTagSearch = collect();

        if ( ! empty($this->title())) {
            $textsForTagSearch->push($this->title());
        }

        if ( ! empty($this->description())) {
            $textsForTagSearch->push($this->description());
        }

        return $textsForTagSearch;

    }

}