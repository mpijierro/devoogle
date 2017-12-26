<?php

namespace Mulidev\Src\Resource\Command;

use Mulidev\Src\Resource\Repository\ResourceMap;
use Mulidev\Src\Resource\Repository\ResourceRepository;

class StoreResourceHandler
{

    /**
     * @var ResourceRepository
     */
    private $resourceRepository;

    public function __construct(ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }


    public function __invoke(StoreResourceCommand $command)
    {

        $dto = $this->createResourceMap($command);

        $this->resourceRepository->create($dto);

    }


    private function createResourceMap(StoreResourceCommand $command)
    {
        return new ResourceMap($command->getTitle(), $command->getDescription(), $command->getUrl(), $this->obtainSlug($command), $command->getCategoryId(), $command->getLangId());
    }

    private function obtainSlug(StoreResourceCommand $command)
    {
        return str_slug($command->getTitle()) . '-' . str_random(5);
    }

}