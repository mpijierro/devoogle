<?php

namespace Devoogle\Src\Search\Library;

use Devoogle\Src\Devoogle\Library\Paginable;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Search\Library\Sphinx\Results;
use Illuminate\Pagination\LengthAwarePaginator;
use SphinxClient;

class SphinxSearchMachine implements SearchMachineInterface
{

    use Paginable;

    /** @var SphinxClient */
    private $sphinx;

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepository;

    /**
     * @var LengthAwarePaginator
     */
    private $paginator;

    public function __construct(ResourceRepositoryRead $resourceRepository)
    {
        $this->sphinx = new SphinxClient();
        $this->resourceRepository = $resourceRepository;
    }

    public function search(string $search): LengthAwarePaginator
    {

        $this->initializePaginable();

        $this->settingSphinx();

        $results = $this->searchInSphinx($search);

        $this->paginator = $this->resourceRepository->searchByIdsAndOrderByIds($results->ids());

        $this->configSnippets($search);

        return $this->paginator;
    }

    /**
     * Extract to config file
     */
    private function settingSphinx (){

        $this->sphinx->SetServer('127.0.0.1', 9312);
        $this->sphinx->setLimits(0, 1000, 1000);
        $this->sphinx->SetMatchMode(SPH_MATCH_EXTENDED2);
        $this->sphinx->SetRankingMode(SPH_RANK_SPH04);
        $this->sphinx->SetSortMode(SPH_SORT_ATTR_DESC, 'published_ts');
    }

    private function searchInSphinx (string $search): Results{

        $results = $this->sphinx->query($search, 'devoogle');

        return new Results($results);

    }

    private function configSnippets (string $search){

        foreach ($this->paginator->all() as $resource){

            //move to config file
            $options = ['before_match' => '<strong>',
                        'after_match'=> '</strong>',
                        'chunk_separator' => ' ... ',
                        'limit' => 300,
                        'around' => 80,
                        'html_strip_mode' => 'none',
                        'limit_passages' => 4,
                        'allow_empty' => true

            ];

            $excerpts=$this->sphinx->BuildExcerpts([$resource->description], 'devoogle', $search, $options);

            if ($excerpts){
                if (count($excerpts)){

                    $resource->description = '';

                    foreach ($excerpts as $excerpt){
                        $resource->description .= $excerpt;
                    }
                }
            }
            else{
                $resource->description = str_limit($resource->description, 150, '...');
            }
        }

    }

}