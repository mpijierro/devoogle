<?php

namespace Mulidev\Src\Version\Query;


use Mulidev\Src\Resource\Repository\ResourceRepository;
use Mulidev\Src\Version\Library\FormEdit;
use Mulidev\Src\Version\Repository\VersionRepositoryRead;

class EditVersionManager
{

    private $version;

    private $formEdit;

    /**
     * @var ResourceRepository
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
