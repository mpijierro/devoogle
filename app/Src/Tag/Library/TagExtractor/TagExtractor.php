<?php

namespace Devoogle\Src\Tag\Library\TagExtractor;

use Illuminate\Support\Collection;

/**
 * Class TagExtractor
 * @package Devoogle\Src\SourceReader\Library
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

        $text = $this->obtainTextsInOneString($texts);

        $this->processText($text);
    }


    private function obtainTextsInOneString(Collection $texts)
    {

        $finalText = '';

        foreach ($texts as $text) {
            $finalText .= ' '.$text;
        }

        return $finalText;

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


    /**
     *
     * search string tag in string text
     * modifiers in patter:
     *      \b : search strictly
     *      /i : If this modifier is set, letters in the pattern match both upper and lower case letters.
     *
     * @param $tag
     * @param $text
     *
     * @return int
     */
    private function tagExistInText($tag, $text)
    {

        $tag = $this->sanitizeTag($tag);

        $tag = $this->addLimitToSearch($tag);

        $pattern = '/'.$tag.'/';

        $pattern = $this->addModifierLowerAndUpperCase($pattern);

        return preg_match($pattern, mb_strtolower($text), $matches);

    }

    private function sanitizeTag(string $tag)
    {
        $tag = trim($tag);

        $tag = mb_strtolower($tag);

        $tag = str_replace('+', '\+', $tag);
        $tag = str_replace('(', '\(', $tag);
        $tag = str_replace(')', '\)', $tag);
        $tag = str_replace('[', '\[', $tag);
        $tag = str_replace(']', '\]', $tag);
        $tag = str_replace('.', '\.', $tag);
        $tag = str_replace('/', '\/', $tag);

        return $tag;
    }


    private function addLimitToSearch(string $search)
    {
        return '\b'.$search.'\b';
    }


    private function addModifierLowerAndUpperCase(string $pattern)
    {
        return $pattern.'i';
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