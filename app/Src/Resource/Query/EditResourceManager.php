<?php

namespace Mulidev\Src\Resource\Query;


use Mulidev\Src\Resource\Library\FormEdit;
use Mulidev\Src\Resource\Repository\ResourceRepository;
use Mulidev\Src\Version\Library\FormCreate;

class EditResourceManager
{

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
    }

    public function getFormEdit()
    {
        return $this->formEdit;
    }

    public function getFormCreateVersion(): FormCreate
    {
        return $this->formCreateVersion;
    }

    public function __invoke(EditResourceQuery $query)
    {
        ($this->formEdit)($query->getUuid());

        ($this->formCreateVersion)($query->getUuid());

    }

}
