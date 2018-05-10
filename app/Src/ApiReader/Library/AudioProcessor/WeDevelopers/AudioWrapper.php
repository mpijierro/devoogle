<?php

namespace Devoogle\Src\ApiReader\Library\AudioProcessor\WeDevelopers;

use Carbon\Carbon;
use Illuminate\Support\Collection;

class AudioWrapper
{

    /**
     * @var \SimpleXMLElement
     */
    private $element;


    public function __construct(\SimpleXMLElement $element)
    {
        $this->element = $element;
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

}