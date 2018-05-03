<?php

namespace Devoogle\Src\Version\Query;

class EditVersionQuery
{

    private $uuid;


    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }


    public function getUuid(): string
    {
        return $this->uuid;
    }

}