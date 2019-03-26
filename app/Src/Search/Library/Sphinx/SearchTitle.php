<?php

namespace Devoogle\Src\Search\Library\Sphinx;

use SphinxClient;

class SearchTitle implements SearchInterface
{

    private $nextSearch = null;

    public function search(Search $search):ResultList
    {

        $search->sphinxClient()->SetMatchMode(SPH_MATCH_EXTENDED2);
        $search->sphinxClient()->SetRankingMode(SPH_RANK_SPH04);
        //$this->sphinx->SetSortMode(SPH_SORT_ATTR_DESC, 'title');

        $target = '@title ' . '("^' . $search->search(). '$" | "' . $search->search() . '" | (' . $search->search() . '))';

        $results = $search->sphinxClient()->query($target, 'devoogle');

        $results = new Results($results);

        if (!is_null($this->nextSearch)){

            $resultList = $this->nextSearch->search($search);

            $resultList->prepend($results);

            return $resultList;

        }

        $list = new ResultList();

        $list->prepend($results);

        return $list;

    }


    public function nextSearch(SearchInterface $handler)
    {
        $this->nextSearch = $handler;
    }

}