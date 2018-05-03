<?php

namespace Devoogle\Src\Version\Command;

use Devoogle\Src\Version\Repository\VersionRepositoryRead;
use Devoogle\Src\Version\Repository\VersionRepositoryWrite;

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