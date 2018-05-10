<?php

namespace Devoogle\Src\Devoogle\Library;

class FinderLink
{

    public function find(string $text)
    {

        $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";

        // Check if there is a url in the text
        if (preg_match($reg_exUrl, $text, $url)) {

            return preg_replace($reg_exUrl, "<a href='".$url[0]."' target='_blank'>".$url[0]."</a> ", $text);
        }

        return $text;

    }

}