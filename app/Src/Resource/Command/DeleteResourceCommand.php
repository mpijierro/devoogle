<?php

namespace Mulidev\Src\Resource\Command;


class DeleteResourceCommand
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
