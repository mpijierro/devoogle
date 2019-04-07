<?php

namespace Devoogle\Src\Search\Library;

use Devoogle\Src\Devoogle\Library\Paginable;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Search\Exceptions\SearchException;
use Devoogle\Src\Search\Library\Sphinx\ExcerptsOptionsInterface;
use Devoogle\Src\Search\Library\Sphinx\Results;
use Devoogle\Src\Search\Library\Sphinx\SphinxOptionsInterface;
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

    /**
     * @var ExcerptsOptionsInterface
     */
    private $excerptsOptions;

    /**
     * @var SphinxOptionsInterface
     */
    private $sphinxOptions;

    public function __construct(ResourceRepositoryRead $resourceRepository, SphinxOptionsInterface $sphinxOptions, ExcerptsOptionsInterface $excerptsOptions)
    {
        $this->sphinx = new SphinxClient();
        $this->resourceRepository = $resourceRepository;
        $this->sphinxOptions = $sphinxOptions;
        $this->excerptsOptions = $excerptsOptions;
    }


    public function search(string $search): LengthAwarePaginator
    {

        $this->initializePaginable();

        $this->settingSphinx();

        $this->checkSphinxConnected();

        $results = $this->searchInSphinx($search);

        $this->paginator = $this->resourceRepository->searchByIdsAndOrderByIds($results->ids());

        $this->configSnippets($search);

        return $this->paginator;
    }


    /**
     * Extract to config file
     */
    private function settingSphinx()
    {
        $this->sphinx->SetServer($this->sphinxOptions->server(), $this->sphinxOptions->port());
        $this->sphinx->setLimits($this->sphinxOptions->offset(), $this->sphinxOptions->limit(), $this->sphinxOptions->max());
        $this->sphinx->SetMatchMode(SPH_MATCH_EXTENDED2);
        $this->sphinx->SetRankingMode(SPH_RANK_SPH04);
        $this->sphinx->SetSortMode(SPH_SORT_ATTR_DESC, 'published_ts');
    }


    private function searchInSphinx(string $search): Results
    {

        $results = $this->sphinx->query($search, 'devoogle');

        return new Results($results);

    }


    private function checkSphinxConnected()
    {

        if ( ! $this->sphinx->_Connect()) {
            SearchException::sphinxIsNotRunning();
        }
    }


    private function configSnippets(string $search)
    {

        foreach ($this->paginator->all() as $resource) {

            $excerpts = $this->sphinx->BuildExcerpts([$resource->description], 'devoogle', $search, $this->excerptsOptions->options());

            if ($excerpts) {
                if (count($excerpts)) {

                    $resource->description = '';

                    foreach ($excerpts as $excerpt) {
                        $resource->description .= $excerpt;
                    }
                }
            } else {
                $resource->description = str_limit($resource->description, 150, '...');
            }
        }

    }

}