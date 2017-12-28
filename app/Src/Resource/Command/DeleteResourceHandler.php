<?php

namespace Mulidev\Src\Resource\Command;

use Mulidev\Src\Resource\Repository\ResourceRepository;

class DeleteResourceHandler
{

    private $resourceRepository;

    private $resource;

    public function __construct(ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }


    public function __invoke(DeleteResourceCommand $command)
    {

        $this->find($command->getUuid());

        $this->delete();

    }

    private function find($uuid)
    {
        $this->resource = $this->resourceRepository->findByUuid($uuid);
    }


    private function delete()
    {
        $this->resourceRepository->delete($this->resource);
    }

}