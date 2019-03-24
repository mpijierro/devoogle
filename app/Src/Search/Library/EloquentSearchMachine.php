<?php

namespace Devoogle\Src\Search\Library;

use Devoogle\Src\Devoogle\Library\Paginable;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentSearchMachine implements SearchMachineInterface
{

    use Paginable;

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepository;

    public function __construct(ResourceRepositoryRead $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }

    public function search(string $search, int $page): LengthAwarePaginator
    {

        $this->initializePaginable();

        return $this->resourceRepository->searchByString($search);

    }
}