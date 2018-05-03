<?php

namespace Devoogle\Src\Version\Query;

class CreateVersionQuery
{

    private $uuid;


    public function __construct(string $parentUuid)
    {
        $this->uuid = $parentUuid;
    }


    public function getUuid(): string
    {
        return $this->uuid;
    }

}