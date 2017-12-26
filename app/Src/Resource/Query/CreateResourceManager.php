<?php

namespace Mulidev\Src\Resource\Query;

use Mulidev\Src\Resource\Library\FormCreate;

class CreateResourceManager
{

    private $formCreate;

    public function __construct(FormCreate $formCreate)
    {
        $this->formCreate = $formCreate;
    }

    public function getFormCreate()
    {
        return $this->formCreate;
    }

    public function __invoke()
    {
        ($this->formCreate)();

    }

}