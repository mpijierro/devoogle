<?php

namespace Devoogle\Src\ApiReader\Platform\Library;

use Illuminate\Support\Collection;

class TagExtractor
{

    protected $tags = [];

    protected $tagsFounded = [];

    public function __invoke(Collection $texts)
    {

        $this->tagsFounded = [];

        $texts->each(function ($text) {
            $this->processText($text);
        });
    }

    private function processText($text)
    {
        foreach ($this->tags as $tag) {

            if ($this->isTagFounded($tag)) {
                continue;
            }

            if ($this->tagExistInText($tag, $text)) {
                $this->addFoundTag($tag);
            }
        }
    }

    private function isTagFounded(string $tag)
    {
        return array_search($tag, $this->tagsFounded);
    }

    private function tagExistInText($tag, $text)
    {

        $pattern = '/' . mb_strtolower(trim($tag)) . '/';

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