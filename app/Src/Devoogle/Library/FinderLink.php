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

        $text = preg_replace('!(\s|^)((https?://)+[a-z0-9_./?=&-]+)!i', ' <a href="$2" target="_blank">$2</a> ', $text);
        $text = preg_replace('!(\s|^)((www\.)+[a-z0-9_./?=&-]+)!i', '<a target="_blank" href="http://$2"  target="_blank">$2</a> ', $text." ");

        $text = str_replace('<a', '<a target="_blank"', $text);

        return $text;


    }

}