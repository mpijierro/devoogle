<?php

namespace Devoogle\Src\Search\Library\Sphinx;

use SphinxClient;

class SearchTitle
{


    public function __invoke(SphinxClient $client, string $search)
    {

        $client->SetMatchMode(SPH_MATCH_EXTENDED2);
        $client->SetRankingMode(SPH_RANK_SPH04);
        //$this->sphinx->SetSortMode(SPH_SORT_ATTR_DESC, 'title');
        $client->setLimits(0, 1000, 1000);

        $target = '@title ' . '("^' . $search . '$" | "' . $search . '" | (' . $search . '))';

        $results = $client->query($target, 'devoogle');

        return $results;

        $ids = [];
        if (isset($results['matches'])){
            $ids = array_keys($results['matches']);
        }



    }

}