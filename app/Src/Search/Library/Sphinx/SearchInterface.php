<?php

namespace Devoogle\Src\Search\Library\Sphinx;

use SphinxClient;

interface SearchInterface
{

    public function nextSearch (SearchInterface $handler);

    public function search (Search $search) : ResultList;

}