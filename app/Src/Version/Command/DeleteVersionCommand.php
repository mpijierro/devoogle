<?php

namespace Mulidev\Src\Version\Command;


class DeleteVersionCommand
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
