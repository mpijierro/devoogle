<?php

namespace Devoogle\Src\Social\Command;

class SocialHandlerCommand
{

    private $provider;


    public function __construct(string $provider)
    {
        $this->provider = $provider;
    }


    public function getProvider(): string
    {
        return $this->provider;
    }

}