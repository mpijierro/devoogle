<?php

namespace Mulidev\Src\Resource\Command;

use Mulidev\Src\Resource\Model\Resource;
use Mulidev\Src\Resource\Repository\ResourceMap;
use Mulidev\Src\Resource\Repository\ResourceRepository;

class UpdateResourceHandler
{

    private $resource;

    private $resourceRepository;

    public function __construct(ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }


    public function __invoke(UpdateResourceCommand $command)
    {

        $this->findResource($command->getUuid());

        $map = $this->createResourceMap($command);

        $this->resourceRepository->update($map, $this->resource->id());

    }


    private function findResource(string $aUuid)
    {
        $this->resource = $this->resourceRepository->findByUuid($aUuid);
    }


    private function createResourceMap(UpdateResourceCommand $command)
    {
        return new ResourceMap($command->getTitle(), $command->getDescription(), $command->getUrl(), '', $command->getCategoryId(), $command->getLangId());
    }


}