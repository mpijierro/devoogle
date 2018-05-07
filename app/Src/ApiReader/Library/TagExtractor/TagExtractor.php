<?php

namespace Devoogle\Src\ApiReader\Library\TagExtractor;

use Illuminate\Support\Collection;

/**
 * Class TagExtractor
 * @package Devoogle\Src\ApiReader\Library
 *
 * This abstract class, receives a collection of texts and looks for labels on it
 *
 */
abstract class TagExtractor
{

    protected $tags = [];

    protected $tagsFounded = [];


    public function extractTag(Collection $texts)
    {

        $this->tagsFounded = [];

        $texts->each(function ($text) {
            $this->processText($text);
        });
    }


    private function processText($text)
    {
        foreach ($this->tags as $key => $tag) {

            if ($this->hasSynonym($tag)) {

                $originTag = $key;
                $sinonyms = $tag;

                $this->processSynonyms($originTag, $sinonyms, $text);

                if ($this->isTagFounded($originTag)) {
                    continue;
                }

                if ($this->tagExistInText($originTag, $text)) {
                    $this->addFoundTag($originTag);
                }
            } else {

                $originTag = $tag;

                if ($this->isTagFounded($originTag)) {
                    continue;
                }

                if ($this->tagExistInText($originTag, $text)) {
                    $this->addFoundTag($originTag);
                }
            }
        }
    }


    private function hasSynonym($tag)
    {
        return is_array($tag);
    }


    /**
     * Search synonyms in text. If one exists, assign as found the original tag.
     *
     * @param string $originTag
     * @param array  $synonyms
     * @param string $text
     */
    private function processSynonyms(string $originTag, array $synonyms, string $text)
    {

        foreach ($synonyms as $synomyn) {

            if ($this->isTagFounded($synomyn)) {
                continue;
            }

            if ($this->tagExistInText($synomyn, $text)) {
                $this->addFoundTag($originTag);
            }

        }

    }


    private function isTagFounded(string $tag)
    {
        return array_search($tag, $this->tagsFounded);
    }


    private function tagExistInText($tag, $text)
    {

        $pattern = '/'.mb_strtolower(trim($tag)).'/';

        return preg_match($pattern, mb_strtolower($text), $matches);

    }


    private function addFoundTag(string $tag)
    {
        $this->tagsFounded[] = $tag;
    }


    public function tagFound()
    {
        return implode(',', $this->tagsFounded);
    }


    public function isTagFound()
    {
        return count($this->tagsFounded);
    }

}