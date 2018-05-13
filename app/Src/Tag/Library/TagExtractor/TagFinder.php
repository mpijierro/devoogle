<?php

namespace Devoogle\Src\Tag\Library\TagExtractor;


use Illuminate\Support\Collection;

class TagFinder
{

    /**
     * @var EventTagExtractor
     */
    private $eventExtractor;
    /**
     * @var AuthorTagExtractor
     */
    private $authorExtractor;
    /**
     * @var CommonTagExtractor
     */
    private $commonExtractor;
    /**
     * @var TechnologyTagExtractor
     */
    private $technologyExtractor;

    public function __construct(
        EventTagExtractor $eventExtractor,
        AuthorTagExtractor $authorExtractor,
        CommonTagExtractor $commonExtractor,
        TechnologyTagExtractor $technologyExtractor
    ) {

        $this->eventExtractor = $eventExtractor;
        $this->authorExtractor = $authorExtractor;
        $this->commonExtractor = $commonExtractor;
        $this->technologyExtractor = $technologyExtractor;
    }

    public function findByEvent(Collection $textsForSearch)
    {
        return $this->searchTags($this->eventExtractor, $textsForSearch);
    }

    private function searchTags(TagExtractor $tagExtractor, Collection $textsForSearch)
    {

        if ( ! $textsForSearch->count()) {
            return '';
        }

        $tagExtractor->extractTag($textsForSearch);

        if ($tagExtractor->isTagFound()) {
            return $tagExtractor->tagFound();
        }

        return '';

    }

    public function findByAuthor(Collection $textsForSearch)
    {
        return $this->searchTags($this->authorExtractor, $textsForSearch);
    }

    public function findByTechnology(Collection $textsForSearch)
    {
        return $this->searchTags($this->technologyExtractor, $textsForSearch);
    }

    public function findByCommonTags(Collection $textsForSearch)
    {
        return $this->searchTags($this->commonExtractor, $textsForSearch);
    }
}