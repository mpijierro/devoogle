<?php

namespace Mulidev\Src\Resource\Command;

use Mulidev\Src\Resource\Repository\ResourceRepositoryRead;
use Mulidev\Src\Resource\Repository\ResourceRepositoryWrite;

class CheckResourceHandler
{

    private $resource;
    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepositoryRead;
    /**
     * @var ResourceRepositoryWrite
     */
    private $resourceRepositoryWrite;

    public function __construct(ResourceRepositoryRead $resourceRepositoryRead, ResourceRepositoryWrite $resourceRepositoryWrite)
    {
        $this->resourceRepositoryRead = $resourceRepositoryRead;
        $this->resourceRepositoryWrite = $resourceRepositoryWrite;
    }

    public function __invoke(CheckResourceCommand $command)
    {

        $this->find($command->getUuid());

        $this->check();

        $this->save();

    }

    private function find(string $aUuid)
    {
        $this->resource = $this->resourceRepositoryRead->findByUuid($aUuid);
    }

    private function check()
    {
        $this->resource->reviewed = true;
    }

    private function save()
    {
        $this->resourceRepositoryWrite->save($this->resource);
    }

}