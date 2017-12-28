<?php

namespace Mulidev\Src\Version\Command;

use Mulidev\Src\Resource\Repository\ResourceRepositoryRead;
use Mulidev\Src\Version\Repository\VersionRepositoryRead;
use Mulidev\Src\Version\Repository\VersionRepositoryWrite;

class DeleteVersionHandler
{
    /**
     * @var VersionRepositoryWrite
     */
    private $versionRepositoryWrite;
    /**
     * @var VersionRepositoryRead
     */
    private $versionRepositoryRead;

    private $version;

    public function __construct(VersionRepositoryRead $versionRepositoryRead, VersionRepositoryWrite $versionRepositoryWrite)
    {
        $this->versionRepositoryWrite = $versionRepositoryWrite;
        $this->versionRepositoryRead = $versionRepositoryRead;
    }

    public function __invoke(DeleteVersionCommand $command)
    {
        $this->find($command->getUuid());

        $this->delete();
    }

    private function find($uuid)
    {
        $this->version = $this->versionRepositoryRead->findByUuid($uuid);
    }

    private function delete()
    {
        $this->versionRepositoryWrite->delete($this->version);
    }


}