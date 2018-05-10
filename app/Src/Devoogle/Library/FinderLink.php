<?php

namespace Devoogle\Src\Devoogle\Library;

class FinderLink
{

    public function find(string $text)
    {

        $pattern = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

        if (preg_match($pattern, $text, $url)) {

            return preg_replace($pattern, "<a href='".$url[0]."' target='_blank'>".$url[0]."</a> ", $text);
        }

        return $text;

    }

}