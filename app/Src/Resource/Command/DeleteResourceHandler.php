<?php

namespace Devoogle\Src\Resource\Command;

use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Resource\Repository\ResourceRepositoryWrite;

class DeleteResourceHandler
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


    public function __invoke(DeleteResourceCommand $command)
    {

        $this->find($command->getUuid());

        $this->deleteVersions();

        $this->delete();

    }


    private function find($uuid)
    {
        $this->resource = $this->resourceRepositoryRead->findByUuid($uuid);
    }


    private function deleteVersions()
    {
        $this->resource->version()->delete();
    }


    private function delete()
    {
        $this->resourceRepositoryWrite->delete($this->resource);
    }

}