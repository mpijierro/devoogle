<?php

namespace Mulidev\Src\Resource\Command;

use Mulidev\Src\Resource\Repository\ResourceRepository;

class CheckResourceHandler
{

    /**
     * @var ResourceRepository
     */
    private $resourceRepository;

    private $resource;

    public function __construct(ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }

    public function __invoke(CheckResourceCommand $command)
    {

        $this->find($command->getUuid());

        $this->check();

        $this->save();

    }

    private function find(string $aUuid)
    {
        $this->resource = $this->resourceRepository->findByUuid($aUuid);
    }

    private function check()
    {
        $this->resource->reviewed = true;
    }

    private function save()
    {
        $this->resourceRepository->save($this->resource);
    }

}