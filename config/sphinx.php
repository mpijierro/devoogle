<?php

return [
    'sphinx' => [
        'server' => env('SPHINX_SERVER', ''),
        'port' => env('SPHINX_PORT', ''),
        'offset' => env('SPHINX_OFFSET', ''),
        'limit' => env('SPHINX_LIMITS', ''),
        'max' => env('SPHINX_MAX', ''),
    ],
    'excerpts' => [
        'before_match' => env('SPHINX_EXCERPTS_BEFORE_MATCH',''),
        'after_match' => env('SPHINX_EXCERPTS_AFTER_MATCH',''),
        'chunk_separator' => env('SPHINX_EXCERPTS_CHUNK_SEPARATOR', ''),
        'limit' => env('SPHINX_EXCERPTS_LIMIT', ''),
        'around' => env('SPHINX_EXCERPTS_AROUND', ''),
        'html_strip_mode' => env('SPHINX_EXCERPTS_HTML_STRIP_MODE', ''),
        'limit_passages' => env('SPHINX_EXCERPTS_LIMIT_PASSAGES', ''),
        'allow_empty' => env('SPHINX_EXCERPTS_ALLOW_EMPTY', '')
    ]
];
