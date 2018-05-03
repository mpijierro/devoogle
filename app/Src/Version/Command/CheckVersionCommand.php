<?php

namespace Devoogle\Src\Version\Command;

class CheckVersionCommand
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