<?php

namespace Devoogle\Src\Search\Library;

use Devoogle\Src\Devoogle\Library\Paginable;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Illuminate\Pagination\LengthAwarePaginator;
use SphinxClient;

class SphinxSearchMachine implements SearchMachineInterface
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

    public function search(string $search): LengthAwarePaginator
    {

        $this->initializePaginable();

        $sphinx = new SphinxClient();
        $sphinx->SetServer('127.0.0.1', 9312);
        $sphinx->SetMatchMode(SPH_MATCH_ALL);
        //$sphinx->SetRankingMode(SPH_RANK_PROXIMITY_BM25);
        $sphinx->SetFieldWeights(["title" => 1, 'description' => 100]);
        $sphinx->SetSortMode ( SPH_SORT_RELEVANCE);

        $sphinx->setLimits(0, 1000, 1000);

        $results = $sphinx->query($search, 'devoogle');

        $ids = [];
        if (isset($results['matches'])){
            $ids = array_keys($results['matches']);
        }

        return $this->resourceRepository->searchByIds($ids);

    }

}