<?php

namespace Devoogle\Src\Resource\Command;


class DestroyResourceCommand
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
