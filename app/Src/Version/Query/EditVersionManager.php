<?php

namespace Devoogle\Src\Version\Query;


use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Version\Library\FormEdit;
use Devoogle\Src\Version\Repository\VersionRepositoryRead;

class EditVersionManager
{

    private $version;

    private $formEdit;

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepository;
    /**
     * @var VersionRepositoryRead
     */
    private $versionRepositoryRead;


    public function __construct(FormEdit $formEdit, VersionRepositoryRead $versionRepositoryRead)
    {
        $this->formEdit = $formEdit;
        $this->versions = collect();

        $this->versionRepositoryRead = $versionRepositoryRead;
    }

    public function formEdit()
    {
        return $this->formEdit;
    }

    public function version()
    {
        return $this->version;
    }


    public function __invoke(EditVersionQuery $query)
    {
        ($this->formEdit)($query->getUuid());

        $this->findVersion($query->getUuid());

    }

    private function findVersion(string $uuid)
    {
        $this->version = $this->versionRepositoryRead->findByUuid($uuid);
    }

}
