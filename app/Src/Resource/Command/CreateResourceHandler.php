<?php

namespace Mulidev\Src\Resource\Command;

use Mulidev\Src\Resource\Library\FormCreate;

class CreateResourceHandler
{

    /**
     * @var FormCreate
     */
    private $formCreate;

    public function __construct(FormCreate $formCreate)
    {
        $this->formCreate = $formCreate;
    }

    /**
     * @return FormCreate
     */
    public function getFormCreate()
    {
        return $this->formCreate;
    }


    public function __invoke(CreateResourceCommand $command)
    {
        ($this->formCreate)();

    }

}