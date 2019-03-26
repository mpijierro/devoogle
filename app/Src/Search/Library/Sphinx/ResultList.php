<?php

namespace Devoogle\Src\Search\Library\Sphinx;

class ResultList
{
    private $results;

    public function __construct()
    {
        $this->results = collect();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function results(): \Illuminate\Support\Collection
    {
        return $this->results;
    }

    public function add(Results $results){
        $this->results->push($results);
    }


}