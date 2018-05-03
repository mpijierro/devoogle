<?php

namespace Devoogle\Src\Version\Query;

use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Version\Library\FormEdit;
use Devoogle\Src\Version\Repository\VersionRepositoryRead;

class EditVersionManager
{

    private $query;

    private $resource;

    private $version;

    private $versions;

    /**
     * @var VersionRepositoryRead
     */
    private $versionRepositoryRead;

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepositoryRead;


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


    public function resource()
    {
        return $this->resource;
    }


    public function version()
    {
        return $this->version;
    }


    public function versions()
    {
        return $this->versions;
    }


    public function __invoke(EditVersionQuery $query)
    {

        $this->initializeQuery($query);

        $this->initializeForm();

        $this->findVersion($query->getUuid());

        $this->findResource();

        $this->findVersions();

    }


    private function initializeQuery(EditVersionQuery $query)
    {
        $this->query = $query;
    }


    private function initializeForm()
    {
        ($this->formEdit)($this->query->getUuid());
    }


    private function findVersion(string $uuid)
    {
        $this->version = $this->versionRepositoryRead->findByUuid($uuid);
    }


    private function findResource()
    {
        $this->resource = $this->version->resource;
    }


    private function findVersions()
    {
        $this->versions = $this->resource->version;
    }

}
