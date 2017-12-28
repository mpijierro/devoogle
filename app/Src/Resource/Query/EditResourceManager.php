<?php

namespace Mulidev\Src\Resource\Query;


use Mulidev\Src\Resource\Library\FormEdit;
use Mulidev\Src\Resource\Repository\ResourceRepository;
use Mulidev\Src\Version\Library\FormCreate;

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
     * @var ResourceRepository
     */
    private $resourceRepository;


    public function __construct(FormEdit $formEdit, FormCreate $formCreateVersion, ResourceRepository $resourceRepository)
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
