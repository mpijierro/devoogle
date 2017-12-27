<?php

namespace Mulidev\Src\Mulidev\Library;

abstract class Form
{

    protected $model = [];

    protected $action = '';


    public function model()
    {
        return $this->model;
    }

    public function action()
    {
        return $this->action;
    }

    abstract protected function configModel();

    abstract protected function configAction();


}