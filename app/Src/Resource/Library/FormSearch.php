<?php

namespace Mulidev\Src\Resource\Library;

use Mulidev\Src\Category\Repository\CategoryRepository;
use Mulidev\Src\Lang\Repository\LangRepository;
use Mulidev\Src\Mulidev\Library\Form;

class FormSearch extends Form
{

    public function __invoke()
    {

        $this->configModel();

        $this->configAction();

    }

    protected function configModel()
    {
        $this->model = [];
    }

    protected function configAction()
    {

        dd(route('home'));

        //$this->action = route('search-resource');

        dd($this->action);
    }

}