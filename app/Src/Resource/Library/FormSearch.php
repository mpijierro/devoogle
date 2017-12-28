<?php

namespace Devoogle\Src\Resource\Library;

use Devoogle\Src\Category\Repository\CategoryRepositoryRead;
use Devoogle\Src\Lang\Repository\LangRepositoryRead;
use Devoogle\Src\Devoogle\Library\Form;

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