<?php

namespace Devoogle\Src\SourceReader\Library;

use Carbon\Carbon;
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


    public function element()
    {
        return $this->element;
    }

    public function url(): string
    {
        return $this->element->link;
    }


    public function publishedAt(): Carbon
    {
        return Carbon::parse((string)$this->element->pubDate);
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


    public function title(): string
    {
        return $this->element->title;
    }


    public function description(): string
    {
        return (string)$this->element->description;
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

}