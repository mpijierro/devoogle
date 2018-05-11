<?php

namespace Devoogle\Src\ApiReader\Library\TagExtractor;

class CommonTagExtractor extends TagExtractor
{

    protected $tags = [
        'Agile',
        'BDD',
        'DDD',
        'Entrevista' => [
            'Hablamos con '
        ],
        'Kanban',
        'Lean' => [
            'Lean Manufacturing',
            'Lean Startup'
        ],
        'Métrica',
        'Microservices',
        'Scrum',
        'TDD',
        ' XP ',
    ];

}