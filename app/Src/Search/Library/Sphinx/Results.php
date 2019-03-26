<?php

namespace Devoogle\Src\Search\Library\Sphinx;

use Illuminate\Support\Collection;

class Results
{

    /**
     * @var array
     */
    private $results;


    public function __construct(array $results)
    {
        $this->results = $results;
    }

    /**
     * @return array
     */
    public function results(): Collection
    {
        return $this->results;
    }

    public function ids ():array{

        if (!isset($results['matches'])){
            throw new \InvalidArgumentException('Field matchs not exists');
        }

        return array_keys($this->results['matches']);
    }
}