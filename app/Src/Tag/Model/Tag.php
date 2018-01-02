<?php

namespace Devoogle\Src\Tag\Model;

class Tag
{
    const TYPE_AUTHOR = 'author';

    const TYPE_EVENT = 'event';


    public static function sanitizeFromInput(string $input)
    {

        $sanitizeInput = trim(str_replace(['[', ']', '"'], '', $input));

        return preg_replace('/( ){2,}/u', ' ', $sanitizeInput);

    }



}