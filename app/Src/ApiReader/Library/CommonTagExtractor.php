<?php

namespace Devoogle\Src\ApiReader\Library;


class CommonTagExtractor extends TagExtractor
{

    protected $tags = [
        'Agile',
        'DDD',
        'Entrevista' => [
            'Hablamos con '
        ],
        'Kanban',
        'Lean' => [
            'Lean Manufacturing',
            'Lean Startup'
        ],
        'Microservices',
        'Scrum',
    ];

}