<?php

namespace Devoogle\Src\Favourite\Query;

use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;

class MostFavouriteListManager
{

    const SIZE_LIST = 50;

    private $resources;

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepositoryRead;


    public function __construct(ResourceRepositoryRead $resourceRepositoryRead)
    {
        $this->resourceRepositoryRead = $resourceRepositoryRead;
    }


    public function __invoke()
    {
        $this->findMoreValued();
    }


    private function findMoreValued()
    {
        $this->resources = $this->resourceRepositoryRead->moreValued(self::SIZE_LIST);
    }


    public function resources()
    {
        return $this->resources;
    }

}