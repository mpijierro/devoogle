<?php

namespace Devoogle\Src\Devoogle\Library;

class SanitizeDescription
{

    const DESCRIPTION_LENGHT = 500;

    public function sanitize(string $text): string
    {

        $text = $this->clearHtmlTags($text);

        return $this->convertLinks($text);

    }


    public function sanitizeWeb(string $text): string
    {

        $text = $this->clearHtmlTags($text);

        $text = str_limit($text, self::DESCRIPTION_LENGHT);

        return $this->convertLinks($text);


    }


    private function clearHtmlTags(string $text): string
    {
        return strip_tags($text, '');
    }


    private function convertLinks(string $text): string
    {
        $text = preg_replace('!(\s|^)((https?://)+[a-z0-9_./?=&-]+)!i', ' <a href="$2" target="_blank">$2</a> ', $text);
        $text = preg_replace('!(\s|^)((www\.)+[a-z0-9_./?=&-]+)!i', '<a target="_blank" href="http://$2"  target="_blank">$2</a> ', $text." ");

        return str_replace('<a', '<a target="_blank"', $text);
    }

}