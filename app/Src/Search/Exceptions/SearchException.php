<?php

namespace Devoogle\Src\Search\Exceptions;

class SearchException extends \Exception
{

    public static function sphinxIsNotRunning(){
        throw new self ('Sphinx is not running');
    }

    public static function searchMachineNotFoundResults (){
        throw new self ('Sphinx not found results');
    }
}