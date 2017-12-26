<?php

namespace Mulidev\Src\Media\Command;

use Mulidev\Src\Media\Library\FormCreate;

class CreateMediaHandler
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


    public function __invoke(CreateMediaCommand $command)
    {
        ($this->formCreate)();

    }

}