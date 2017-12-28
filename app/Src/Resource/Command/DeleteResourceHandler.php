<?php

namespace Mulidev\Src\Resource\Command;

use Mulidev\Src\Resource\Repository\ResourceRepository;

class DeleteResourceHandler
{

    /**
     * @var ResourceRepository
     */
    private $resourceRepository;

    public function __construct(ResourceRepository $resourceRepository)
    {
        $this->resourceRepository = $resourceRepository;
    }


    public function __invoke(DeleteVersionCommand $command)
    {

        $this->resourceRepository->delete($command->getUuid());

    }


}