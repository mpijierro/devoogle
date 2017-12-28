<?php

namespace Devoogle\Src\Resource\Query;


use Devoogle\Src\Resource\Library\FormEdit;
use Devoogle\Src\Resource\Repository\ResourceRepositoryRead;
use Devoogle\Src\Version\Library\FormCreate;

class EditResourceManager
{

    private $resource;

    private $versions;

    private $formEdit;

    /**
     * @var FormCreateVersion
     */
    private $formCreateVersion;

    /**
     * @var ResourceRepositoryRead
     */
    private $resourceRepository;


    public function __construct(FormEdit $formEdit, FormCreate $formCreateVersion, ResourceRepositoryRead $resourceRepository)
    {
        $this->formEdit = $formEdit;
        $this->resourceRepository = $resourceRepository;
        $this->formCreateVersion = $formCreateVersion;

        $this->versions = collect();
    }

    public function getFormEdit()
    {
        return $this->formEdit;
    }

    public function getFormCreateVersion(): FormCreate
    {
        return $this->formCreateVersion;
    }

    public function resource()
    {
        return $this->resource;
    }

    public function versions()
    {
        return $this->versions;
    }

    public function __invoke(EditResourceQuery $query)
    {
        ($this->formEdit)($query->getUuid());

        ($this->formCreateVersion)($query->getUuid());

        $this->obtainVersions($query->getUuid());

    }

    private function obtainVersions(string $uuid)
    {

        $this->findResource($uuid);

        $this->versions = $this->resource->version;

    }

    private function findResource(string $uuid)
    {
        $this->resource = $this->resourceRepository->findByUuid($uuid);
    }



}
