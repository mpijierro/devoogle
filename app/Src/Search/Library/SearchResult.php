<?php
namespace Devoogle\Src\Search\Library;

use Devoogle\Src\Resource\Model\Resource;
use Illuminate\Support\Collection;

class SearchResult
{

    private $results;

    public function __construct()
    {
        $this->results = collect();
    }

    public function push (Resource $resource){
        $this->results->push($resource);
    }

    public function all():Collection{
        return $this->results;
    }

}