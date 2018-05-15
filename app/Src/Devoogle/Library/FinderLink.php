<?php

namespace Devoogle\Src\Devoogle\Library;

class FinderLink
{

    private $pattern = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";


    public function obtainUrls(string $text)
    {

        if (preg_match_all($this->pattern, $text, $urls)) {

            return $urls[0];

        }

        return [];
    }


    public function urlFromDomain(string $text, string $domain): string
    {

        $urls = $this->obtainUrls($text);
        $pattern = '/'.$domain.'/';

        foreach ($urls as $url) {

            if (preg_match($pattern, $url, $matches)) {
                return $url;
            }
        }

        return '';

    }


    public function replaceUrlsByLinks(string $text): string
    {

        if (preg_match_all($this->pattern, $text, $urls)) {

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