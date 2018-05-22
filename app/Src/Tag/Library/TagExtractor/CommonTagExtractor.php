<?php

namespace Devoogle\Src\Tag\Library\TagExtractor;

class CommonTagExtractor extends TagExtractor
{

    protected $tags = [
        'Agile',
        'Arquitectura Hexagonal' => [
            'Hexagonal architecture'
        ],
        'BDD',
        'CI/CD ',
        'CQRS',
        'Curso',
        'Deuda técnica',
        'DDD'                    => [
            'domain driven design',
            'domain-driven design',
        ],
        'Entrevista'             => [
            'Hablamos con '
        ],
        'Kanban',
        'Lean'                   => [
            'Lean Manufacturing',
            'Lean Startup'
        ],
        'Métrica',
        'Microservicios'         => [
            'Microservice'
        ],
        'OWASP',
        'Pair programming',
        'Refactoring',
        'Scrum',
        'Solid',
        'TDD',
        ' XP ',
    ];

}