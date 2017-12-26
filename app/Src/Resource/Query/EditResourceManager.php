<?php

namespace Mulidev\Src\Resource\Query;

use Mulidev\Src\Resource\Library\FormEdit;
use Mulidev\Src\Resource\Repository\ResourceRepository;

class EditResourceManager
{

    private $formEdit;
    /**
     * @var ResourceRepository
     */
    private $resourceRepository;

    public function __construct(FormEdit $formEdit, ResourceRepository $resourceRepository)
    {
        $this->formEdit = $formEdit;
        $this->resourceRepository = $resourceRepository;
    }

    public function getFormEdit()
    {
        return $this->formEdit;
    }

    public function __invoke(EditResourceQuery $query)
    {
        ($this->formEdit)($query->getUuid());

    }

}
