<?php

namespace Devoogle\Src\Version\Query;


use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Version\Library\FormCreate;
use Devoogle\Src\Version\Library\FormEdit;
use Devoogle\Src\Version\Repository\VersionRepositoryRead;

class CreateVersionManager
{

    /**
     * @var VersionRepositoryRead
     */
    private $versionRepositoryRead;
    /**
     * @var FormCreate
     */
    private $formCreate;
    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepositoryRead;

    private $query;

    private $versions;

    private $resource;

    public function __construct(FormCreate $formCreate, ResourceRepositoryRead $resourceRepositoryRead, VersionRepositoryRead $versionRepositoryRead)
    {

        $this->versions = collect();

        $this->formCreate = $formCreate;
        $this->resourceRepositoryRead = $resourceRepositoryRead;
        $this->versionRepositoryRead = $versionRepositoryRead;
    }

    public function formCreate()
    {
        return $this->formCreate;
    }

    public function versions()
    {
        return $this->versions;
    }

    public function resource()
    {
        return $this->resource;
    }

    public function __invoke(CreateVersionQuery $query)
    {

        $this->initializeQuery($query);

        $this->initializeForm();

        $this->findResource();

        $this->findVersions();

    }

    private function initializeQuery(CreateVersionQuery $query)
    {
        $this->query = $query;
    }

    private function initializeForm()
    {
        ($this->formCreate)($query->getUuid());
    }

    private function findResource()
    {
        $this->resource = $this->resourceRepositoryRead->findByUuid($this->query->getUuid());
    }

    private function findVersions()
    {
        $this->versions = $this->resource->version;
    }

}
