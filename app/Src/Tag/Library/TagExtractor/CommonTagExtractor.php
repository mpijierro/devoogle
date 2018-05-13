<?php

namespace Devoogle\Src\Tag\Library\TagExtractor;

class CommonTagExtractor extends TagExtractor
{

    protected $tags = [
        'Agile',
        'Arquitectura Hexagonal',
        'CQRS',
        'BDD',
        'DDD'            => [
            'domain driven design',
            'domain-driven design',
        ],
        'Entrevista'     => [
            'Hablamos con '
        ],
        'Kanban',
        'Lean'           => [
            'Lean Manufacturing',
            'Lean Startup'
        ],
        'Métrica',
        'Microservicios' => [
            'Microservice'
        ],
        'Scrum',
        'Solid',
        'TDD',
        ' XP ',
    ];

}