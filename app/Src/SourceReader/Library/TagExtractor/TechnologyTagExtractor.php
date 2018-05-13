<?php

namespace Devoogle\Src\SourceReader\Library\TagExtractor;

class TechnologyTagExtractor extends TagExtractor
{

    protected $tags = [
        ' .net ',
        'Android',
        'Ansible',
        'Ansistrano',
        'Apache',
        'Arduino',
        'Azure',
        'Behat',
        ' C++ ',
        'Cassandra',
        'Cobol',
        'CodeIgniter'  => [
            'code igniter'
        ],
        'Coffeescript',
        'Django',
        'Docker',
        'Drupal',
        'Eclipsse',
        'Erlang',
        ' Go ',
        'GraphQl',
        'Groovy',
        'HipChat',
        'HTTP',
        'IOS',
        'Javascript',
        'Java',
        'jQuery',
        'jSon',
        'Kubernetes',
        'Laravel',
        'MySQL',
        'MongoDB'      => [
            'mongo'
        ],
        'Node',
        'NoSql',
        'Objetive-C',
        'PHP',
        'PHPUnit',
        'PostgreSQL',
        'Python',
        'RabbitMQ'     => [
            'rabbit'
        ],
        'React',
        'Redis',
        ' Rest ',
        ' Sap ',
        'Scala',
        'Spectrum',
        'Symfony'      => [
            'symfony2',
            'symfony3',
            'symfony4'
        ],
        'Swift',
        'Unity',
        'Visual Basic' => [
            'visualbasic'
        ],
        'Xamarin'
    ];

}