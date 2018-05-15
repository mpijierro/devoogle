<?php

namespace Devoogle\Src\Version\Library;

use Devoogle\Src\Category\Model\Category;
use Devoogle\Src\Devoogle\Library\FinderLink;
use Devoogle\Src\Resource\Model\Resource;
use Devoogle\Src\User\Model\User;
use Devoogle\Src\Version\Command\StoreVersionCommand;
use Devoogle\Src\Version\Command\StoreVersionHandler;
use Webpatser\Uuid\Uuid;

class IvooxGenerator
{

    const DOMAIN = 'ivoox';

    /**
     * @var Resource
     */
    private $resource;

    private $user;

    /**
     * @var FinderLink
     */
    private $finderLink;

    private $ivooxUrl = '';


    public function __construct(FinderLink $finderLink)
    {
        $this->finderLink = $finderLink;
    }


    public function generate(Resource $resource, User $user)
    {

        $this->initializeResource($resource);

        $this->initializeUser($user);

        $this->searchIvooxUrl();

        if ($this->hasIvooxUrl()) {
            $this->create();
        }


    }


    private function initializeResource(Resource $resource)
    {
        $this->resource = $resource;
    }


    private function initializeUser(User $user)
    {
        $this->user = $user;
    }


    private function searchIvooxUrl()
    {
        $this->ivooxUrl = $this->finderLink->urlFromDomain($this->resource->description(), self::DOMAIN);
    }


    private function hasIvooxUrl()
    {
        return ! empty($this->ivooxUrl);
    }


    public function create()
    {

        $uuid = Uuid::generate();

        $command = new StoreVersionCommand($uuid, $this->resource->uuid(), $this->user->id(), Category::AUDIO_CATEGORY_ID, $this->ivooxUrl, '');
        $handler = app(StoreVersionHandler::class);
        $handler($command);

    }

}