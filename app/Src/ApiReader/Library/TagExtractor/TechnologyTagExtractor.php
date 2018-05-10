<?php

namespace Devoogle\Src\ApiReader\Library\TagExtractor;

class TechnologyTagExtractor extends TagExtractor
{

    protected $tags = [
        'Android',
        'Ansible',
        'Ansistrano',
        'Azure',
        'Behat',
        ' C++ ',
        'CodeIgniter' => [
            'code igniter'
        ],
        'Drupal',
        ' Go ',
        'GraphQl',
        'Groovy',
        'IOS',
        'Javascript',
        'Java',
        'Laravel',
        'MySQL',
        'MongoDB'     => [
            'mongo'
        ],
        'Node',
        'PHP',
        'PHPUnit',
        'PostgreSQL',
        'Python',
        'RabbitMQ'    => [
            'rabbit'
        ],
        'React',
        ' Rest ',
        'Scala',
        'Symfony'     => [
            'symfony2',
            'symfony3',
            'symfony4'
        ]
    ];

}