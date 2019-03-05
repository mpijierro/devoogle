<?php

namespace Devoogle\Src\Resource\Query;


use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;

class ReadResourceBySlugManager
{

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepositoryRead;

    public function __construct(ResourceRepositoryRead $resourceRepositoryRead)
    {
        $this->resourceRepositoryRead = $resourceRepositoryRead;
    }

    public function __invoke(ReadResourceBySlugQuery $query):Resource
    {
        return $this->resourceRepositoryRead->findBySlug($query->slug());
    }


}