<?php

namespace Devoogle\Src\Search\Library;

use Devoogle\Src\Devoogle\Library\Paginable;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Search\Library\Sphinx\SearchTitle;
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

        $this->sphinx->SetServer('127.0.0.1', 9312);

        $searchTitle= app(SearchTitle::class);
        $results = $searchTitle($this->sphinx, $search);

        dd($results);



        $this->paginator = $this->resourceRepository->searchByIds($ids);

        $this->configSnippets($search);

        return $this->paginator;
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

                    if (count($excerpts) > 1){
                        dd(count($excerpts));
                    }

                    $resource->description = '';

                    foreach ($excerpts as $excerpt){
                        $resource->description .= $excerpt;
                    }

                }
            }
            else{
                $resource->description = str_limit($resource->description, 150, '...');
            }


            /*
            if ($resource->id == 245){
                dd($excerpts, $resource->description);
            }
            */

        }

    }

}