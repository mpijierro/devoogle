<?php

namespace Mulidev\Src\Version\Command;

use Mulidev\Src\Resource\Repository\ResourceRepository;
use Mulidev\Src\Version\Repository\VersionRepositoryWrite;
use Mulidev\Src\Version\Model\Version;


class StoreVersionHandler
{

    private $command;

    private $parentResource;

    private $version;
    /**
     * @var VersionRepositoryWrite
     */
    private $versionRepositoryWrite;
    /**
     * @var ResourceRepository
     */
    private $resourceRepository;

    public function __construct(VersionRepositoryWrite $versionRepositoryWrite, ResourceRepository $resourceRepository)
    {

        $this->versionRepositoryWrite = $versionRepositoryWrite;
        $this->resourceRepository = $resourceRepository;
    }


    public function __invoke(StoreVersionCommand $command)
    {

        $this->initializeCommand($command);

        $this->findParentResource();

        $this->fill();

        $this->create();

    }

    private function initializeCommand(StoreVersionCommand $command)
    {
        $this->command = $command;
    }

    private function findParentResource()
    {
        $this->parentResource = $this->resourceRepository->findByUuid($this->command->getParentUuid());
    }

    private function fill()
    {
        $this->version = new Version();
        $this->version->uuid = $this->command->getUuid();
        $this->version->user_id = $this->command->getUserId();
        $this->version->resource_id = $this->parentResource->id;
        $this->version->category_id = $this->command->getCategoryId();
        $this->version->url = $this->command->getUrl();
        $this->version->comment = $this->command->getComment();
    }

    private function create()
    {
        $this->versionRepositoryWrite->save($this->version);
    }


}