<?php

namespace Devoogle\Src\Resource\Command;

class SendDownloadResourceCommand
{

    /**
     * @var string
     */
    private $slug;

    /**
     * @var string
     */
    private $email;

    public function __construct(string $slug, string $email)
    {
        $this->slug = $slug;
        $this->email = $email;
    }


    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

}