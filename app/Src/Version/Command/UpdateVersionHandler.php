<?php

namespace Devoogle\Src\Version\Command;

use Devoogle\Src\Version\Repository\VersionRepositoryRead;
use Devoogle\Src\Version\Repository\VersionRepositoryWrite;

class UpdateVersionHandler
{

    private $command;

    private $version;
    /**
     * @var VersionRepositoryRead
     */
    private $versionRepositoryRead;
    /**
     * @var VersionRepositoryWrite
     */
    private $versionRepositoryWrite;


    public function __construct(VersionRepositoryRead $versionRepositoryRead, VersionRepositoryWrite $versionRepositoryWrite)
    {
        $this->versionRepositoryRead = $versionRepositoryRead;
        $this->versionRepositoryWrite = $versionRepositoryWrite;
    }


    public function __invoke(UpdateVersionCommand $command)
    {

        $this->initializeCommand($command);

        $this->find($command->getUuid());

        $this->fill();

        $this->update();

    }

    private function initializeCommand(UpdateVersionCommand $command)
    {
        $this->command = $command;
    }

    private function find(string $aUuid)
    {
        $this->version = $this->versionRepositoryRead->findByUuid($aUuid);
    }

    private function fill()
    {

        $this->version->url = $this->command->getUrl();
        $this->version->category_id = $this->command->getCategoryId();
        $this->version->comment = $this->command->getComment();

    }

    private function update()
    {
        $this->versionRepositoryWrite->save($this->version);
    }


}