<?php

namespace Devoogle\Src\Search\Library\Sphinx;

use SphinxClient;

interface SearchInterface
{

    public function search (ConfigSearch $search) : Results;

}