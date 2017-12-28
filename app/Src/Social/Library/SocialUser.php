<?php

namespace Devoogle\Src\Social\Library;

abstract class SocialUser
{

    const GENDER_MALE = 'male';

    const GENDER_FEMALE = 'female';

    protected $data = [];

    public function __construct($data)
    {
        $this->data = $data;
    }

    abstract public function id();

    abstract public function username();

    abstract public function name();

    abstract public function firstName();

    abstract public function lastName();

    abstract public function email();

    protected function getField($field)
    {

        if ( ! isset($this->data[$field])) {
            return '';
            //Fixme: valorar lanzar esta excepción. Hay algunos campos que existen pero tienen valor nulo y salta.
            throw new \InvalidArgumentException(sprintf("Field %s not found", $field));
        }

        return $this->data[$field];
    }

}
