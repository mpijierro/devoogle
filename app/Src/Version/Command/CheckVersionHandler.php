<?php

namespace Devoogle\Src\Version\Command;

use Devoogle\Src\Version\Repository\VersionRepositoryRead;
use Devoogle\Src\Version\Repository\VersionRepositoryWrite;

class CheckVersionHandler
{

    private $version;

    /**
     * @var VersionRepositoryWrite
     */
    private $versionRepositoryWrite;

    /**
     * @var VersionRepositoryRead
     */
    private $versionRepositoryRead;


    public function __construct(VersionRepositoryRead $versionRepositoryRead, VersionRepositoryWrite $versionRepositoryWrite)
    {
        $this->versionRepositoryWrite = $versionRepositoryWrite;
        $this->versionRepositoryRead = $versionRepositoryRead;
    }


    public function __invoke(CheckVersionCommand $command)
    {

        $this->find($command->getUuid());

        $this->check();

        $this->save();

    }


    private function find(string $aUuid)
    {
        $this->version = $this->versionRepositoryRead->findByUuid($aUuid);
    }


    private function check()
    {
        $this->version->reviewed = true;
    }


    private function save()
    {
        $this->versionRepositoryWrite->save($this->version);
    }

}