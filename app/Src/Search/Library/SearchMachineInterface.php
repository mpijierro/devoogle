<?php

namespace Devoogle\Src\Search\Library;

use Illuminate\Pagination\LengthAwarePaginator;

interface SearchMachineInterface
{
    public function search (string $search):LengthAwarePaginator;
}