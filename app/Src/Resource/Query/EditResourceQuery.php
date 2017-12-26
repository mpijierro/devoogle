<?php

namespace Mulidev\Src\Resource\Query;

class EditResourceQuery
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