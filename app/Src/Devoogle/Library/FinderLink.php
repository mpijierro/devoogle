<?php

namespace Devoogle\Src\Devoogle\Library;

class FinderLink
{

    public function find(string $text)
    {

        $pattern = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

        if (preg_match_all($pattern, $text, $urls)) {

            return $this->replaceMatch($text, $urls[0]);

        }

        return $text;

    }


    private function replaceMatch(string $text, array $urls)
    {

        foreach ($urls as $match) {
            $text = str_replace($match, "<a href='".$match."' target='_blank'>".$match."</a> ", $text);
        }

        return $text;

    }

}