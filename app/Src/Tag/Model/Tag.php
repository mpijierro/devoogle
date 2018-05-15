<?php

namespace Devoogle\Src\Tag\Model;

class Tag
{

    const TYPE_AUTHOR = 'author';

    const TYPE_EVENT = 'event';

    const TYPE_TECHNOLOGY = 'technology';

    const TYPE_COMMON = 'tag';


    public static function sanitizeFromInput(string $input)
    {

        $sanitizeInput = trim(str_replace(['[', ']', '"'], '', $input));

        $modifierUtf8 = 'u';

        return preg_replace('/( ){2,}/'.$modifierUtf8, ' ', $sanitizeInput);

    }

}