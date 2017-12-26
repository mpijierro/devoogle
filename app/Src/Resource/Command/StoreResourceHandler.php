<?php

namespace Mulidev\Src\Resource\Command;

use Mulidev\Src\Resource\Repository\CreateResourceDto;
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

        $dto = $this->createDto($command);

        $this->resourceRepository->create($dto);

    }


    private function createDto(StoreResourceCommand $command)
    {
        return new CreateResourceDto($command->getTitle(), $command->getDescription(), $command->getUrl(), $command->getCategoryId(), $command->getLangId());
    }

}